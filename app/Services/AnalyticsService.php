<?php

namespace App\Services;

use App\Models\AnalyticsPageView;
use Illuminate\Support\Facades\DB;

class AnalyticsService
{
    private static ?array $viewsCache = null;

    public function track(string $path, ?string $title = null, ?string $referrer = null): void
    {
        $path = '/' . trim($path, '/');
        if ($path === '/') {
            $path = '/';
        }

        if ($this->shouldSkip($path)) {
            return;
        }

        if ($this->usesDatabase()) {
            AnalyticsPageView::create([
                'page_path' => $path,
                'page_title' => $title,
                'referrer' => $referrer,
                'viewed_at' => now(),
            ]);

            return;
        }

        $store = CmsStorage::readJson();
        $views = $store['analytics_views'] ?? [];
        $views[] = [
            'page_path' => $path,
            'page_title' => $title,
            'referrer' => $referrer,
            'viewed_at' => now()->toDateTimeString(),
        ];

        if (count($views) > 5000) {
            $views = array_slice($views, -5000);
        }

        $store['analytics_views'] = $views;
        CmsStorage::writeJson($store);
        self::$viewsCache = null;
    }

    public function dashboardStats(OrderRepository $orders): array
    {
        if ($this->usesDatabase()) {
            $summary = $this->summaryStats($orders);
            $topPages = AnalyticsPageView::query()
                ->select('page_path', DB::raw('COUNT(*) AS views_count'))
                ->groupBy('page_path')
                ->orderByDesc('views_count')
                ->limit(10)
                ->pluck('views_count', 'page_path')
                ->map(fn ($count) => (int) $count)
                ->all();

            $start = now()->subDays(6)->startOfDay();
            $daily = AnalyticsPageView::query()
                ->selectRaw('DATE(viewed_at) AS view_date, COUNT(*) AS views_count')
                ->where('viewed_at', '>=', $start)
                ->groupBy(DB::raw('DATE(viewed_at)'))
                ->pluck('views_count', 'view_date')
                ->all();

            $viewsByDay = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = now()->subDays($i)->format('Y-m-d');
                $viewsByDay[$date] = (int) ($daily[$date] ?? 0);
            }

            return array_merge($summary, [
                'top_pages' => $topPages,
                'total_chats' => $this->chatCount(),
                'views_by_day' => $viewsByDay,
                'recent_views' => [],
            ]);
        }

        $views = $this->allViews();
        $today = now()->format('Y-m-d');
        $weekAgo = now()->subDays(7)->format('Y-m-d');

        $viewsToday = collect($views)->filter(fn ($v) => str_starts_with($v['viewed_at'] ?? '', $today))->count();
        $viewsWeek = collect($views)->filter(fn ($v) => ($v['viewed_at'] ?? '') >= $weekAgo)->count();

        $byPage = collect($views)
            ->groupBy('page_path')
            ->map(fn ($g) => $g->count())
            ->sortDesc()
            ->take(10);

        $chatLogs = $this->chatLogs();

        return [
            'total_views' => count($views),
            'views_today' => $viewsToday,
            'views_week' => $viewsWeek,
            'top_pages' => $byPage->all(),
            'total_orders' => count($orders->serviceOrders()),
            'total_inquiries' => count($orders->inquiries()),
            'total_chats' => count($chatLogs),
            'views_by_day' => $this->viewsByDay($views, 7),
            'recent_views' => array_slice($views, 0, 25),
        ];
    }

    public function summaryStats(OrderRepository $orders): array
    {
        $counts = $orders->counts();

        if ($this->usesDatabase()) {
            $row = DB::selectOne(
                'SELECT COUNT(*) AS total_views, SUM(CASE WHEN viewed_at >= ? THEN 1 ELSE 0 END) AS views_today, SUM(CASE WHEN viewed_at >= ? THEN 1 ELSE 0 END) AS views_week FROM analytics_page_views',
                [now()->startOfDay(), now()->subDays(6)->startOfDay()]
            );

            return [
                'total_views' => (int) ($row->total_views ?? 0),
                'views_today' => (int) ($row->views_today ?? 0),
                'views_week' => (int) ($row->views_week ?? 0),
                'total_orders' => $counts['orders'],
                'total_inquiries' => $counts['inquiries'],
            ];
        }

        $views = $this->allViews();
        $today = now()->format('Y-m-d');
        $weekAgo = now()->subDays(7)->format('Y-m-d');

        return [
            'total_views' => count($views),
            'views_today' => collect($views)->filter(fn ($v) => str_starts_with($v['viewed_at'] ?? '', $today))->count(),
            'views_week' => collect($views)->filter(fn ($v) => ($v['viewed_at'] ?? '') >= $weekAgo)->count(),
            'total_orders' => $counts['orders'],
            'total_inquiries' => $counts['inquiries'],
        ];
    }

    protected function allViews(): array
    {
        if (self::$viewsCache !== null) {
            return self::$viewsCache;
        }

        if ($this->usesDatabase()) {
            return self::$viewsCache = AnalyticsPageView::orderByDesc('viewed_at')->limit(1000)->get()->toArray();
        }

        $views = CmsStorage::readJson()['analytics_views'] ?? [];

        return self::$viewsCache = array_slice($views, -1000);
    }

    protected function viewsByDay(array $views, int $days): array
    {
        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $result[$date] = collect($views)->filter(fn ($v) => str_starts_with($v['viewed_at'] ?? '', $date))->count();
        }

        return $result;
    }

    protected function usesDatabase(): bool
    {
        try {
            return CmsStorage::hasTable('analytics_page_views');
        } catch (\Throwable $e) {
            return false;
        }
    }

    protected function shouldSkip(string $path): bool
    {
        $path = trim($path, '/');

        return str_starts_with($path, 'admin')
            || str_starts_with($path, 'portal')
            || $path === 'chat'
            || $path === 'sitemap.xml';
    }

    protected function chatLogs(): array
    {
        try {
            if (CmsStorage::hasTable('chatbot_logs')) {
                return \Illuminate\Support\Facades\DB::table('chatbot_logs')->orderByDesc('created_at')->limit(1000)->get()->map(fn ($row) => (array) $row)->toArray();
            }
        } catch (\Throwable $e) {
            return [];
        }

        return CmsStorage::readJson()['chatbot_logs'] ?? [];
    }

    protected function chatCount(): int
    {
        try {
            if (CmsStorage::hasTable('chatbot_logs')) {
                return DB::table('chatbot_logs')->count();
            }
        } catch (\Throwable $e) {
            return 0;
        }

        return count(CmsStorage::readJson()['chatbot_logs'] ?? []);
    }
}
