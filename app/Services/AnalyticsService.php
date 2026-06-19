<?php

namespace App\Services;

use App\Models\AnalyticsPageView;
use Illuminate\Support\Facades\Schema;

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
            return CmsStorage::usesDatabase() && Schema::hasTable('analytics_page_views');
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
            if (CmsStorage::usesDatabase() && Schema::hasTable('chatbot_logs')) {
                return \Illuminate\Support\Facades\DB::table('chatbot_logs')->orderByDesc('created_at')->limit(1000)->get()->map(fn ($row) => (array) $row)->toArray();
            }
        } catch (\Throwable $e) {
            return [];
        }

        return CmsStorage::readJson()['chatbot_logs'] ?? [];
    }
}
