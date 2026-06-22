<?php

namespace App\Services;

use App\Models\Inquiry;
use App\Models\ServiceOrder;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository
{
    private static ?array $inquiryCache = null;

    private static ?array $orderCache = null;

    public function serviceOrders(): array
    {
        return collect($this->getServiceOrders())
            ->map(fn ($row) => $this->formatServiceOrder($row))
            ->sortByDesc('created_at')
            ->values()
            ->all();
    }

    public function inquiries(): array
    {
        return collect($this->getInquiries())
            ->map(fn ($row) => $this->formatInquiry($row))
            ->sortByDesc('created_at')
            ->values()
            ->all();
    }

    public function paginatedServiceOrders(int $perPage = 25): LengthAwarePaginator
    {
        if ($this->usesDatabase()) {
            $paginator = ServiceOrder::orderByDesc('created_at')->paginate($perPage);
            $paginator->setCollection($paginator->getCollection()->map(
                fn ($row) => $this->formatServiceOrder($row->toArray())
            ));

            return $paginator;
        }

        return $this->arrayPaginator($this->serviceOrders(), $perPage);
    }

    public function paginatedInquiries(int $perPage = 25): LengthAwarePaginator
    {
        if ($this->usesDatabase()) {
            $paginator = Inquiry::orderByDesc('created_at')->paginate($perPage);
            $paginator->setCollection($paginator->getCollection()->map(
                fn ($row) => $this->formatInquiry($row->toArray())
            ));

            return $paginator;
        }

        return $this->arrayPaginator($this->inquiries(), $perPage);
    }

    public function counts(): array
    {
        if ($this->usesDatabase()) {
            $row = DB::selectOne(
                'SELECT (SELECT COUNT(*) FROM service_orders) AS orders_count, (SELECT COUNT(*) FROM inquiries) AS inquiries_count'
            );

            return [
                'orders' => (int) ($row->orders_count ?? 0),
                'inquiries' => (int) ($row->inquiries_count ?? 0),
            ];
        }

        return ['orders' => count($this->serviceOrders()), 'inquiries' => count($this->inquiries())];
    }

    public function allOrders(): array
    {
        return array_merge($this->serviceOrders(), $this->inquiries());
    }

    public function find(int $id, string $type): ?array
    {
        if ($type === 'inquiry') {
            $row = $this->findInquiry($id);

            return $row ? $this->formatInquiry($row) : null;
        }

        if ($type === 'service_agreement' || $type === 'order') {
            $row = $this->findServiceOrder($id);

            return $row ? $this->formatServiceOrder($row) : null;
        }

        return null;
    }

    public function findInquiryOnly(int $id): ?array
    {
        $row = $this->findInquiry($id);

        return $row ? $this->formatInquiry($row) : null;
    }

    public function findOrderOnly(int $id): ?array
    {
        $row = $this->findServiceOrder($id);

        return $row ? $this->formatServiceOrder($row) : null;
    }

    public function countNew(): int
    {
        return collect($this->allOrders())->where('status', 'new')->count();
    }

    protected function usesDatabase(): bool
    {
        try {
            return CmsStorage::usesDatabase();
        } catch (\Throwable $e) {
            return false;
        }
    }

    protected function getInquiries(): array
    {
        if (self::$inquiryCache !== null) {
            return self::$inquiryCache;
        }

        if ($this->usesDatabase() && CmsStorage::hasTable('inquiries')) {
            return self::$inquiryCache = Inquiry::orderByDesc('created_at')->limit(200)->get()->toArray();
        }

        return self::$inquiryCache = $this->readJson(base_path('backend/storage/inquiries.json'));
    }

    protected function getServiceOrders(): array
    {
        if (self::$orderCache !== null) {
            return self::$orderCache;
        }

        if ($this->usesDatabase() && CmsStorage::hasTable('service_orders')) {
            return self::$orderCache = ServiceOrder::orderByDesc('created_at')->limit(200)->get()->toArray();
        }

        return self::$orderCache = $this->readJson(base_path('backend/storage/service_orders.json'));
    }

    protected function findInquiry(int $id): ?array
    {
        if ($this->usesDatabase() && CmsStorage::hasTable('inquiries')) {
            $row = Inquiry::find($id);

            return $row ? $row->toArray() : null;
        }

        foreach ($this->readJson(base_path('backend/storage/inquiries.json')) as $row) {
            if ((int) ($row['id'] ?? 0) === $id) {
                return $row;
            }
        }

        return null;
    }

    protected function findServiceOrder(int $id): ?array
    {
        if ($this->usesDatabase() && CmsStorage::hasTable('service_orders')) {
            $row = ServiceOrder::find($id);

            return $row ? $row->toArray() : null;
        }

        foreach ($this->readJson(base_path('backend/storage/service_orders.json')) as $row) {
            if ((int) ($row['id'] ?? 0) === $id) {
                return $row;
            }
        }

        return null;
    }

    protected function readJson(string $path): array
    {
        if (! file_exists($path)) {
            return [];
        }

        $data = json_decode(file_get_contents($path), true);

        return is_array($data) ? $data : [];
    }

    protected function formatInquiry(array $row): array
    {
        return [
            'id' => $row['id'] ?? 0,
            'type' => 'inquiry',
            'type_label' => 'Contact Inquiry',
            'customer_name' => trim(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? '')),
            'email' => $row['email'] ?? '',
            'phone' => $row['phone_number'] ?? $row['phone'] ?? '',
            'vehicle_type' => $row['vehicle_type'] ?? '',
            'vehicle_no' => '',
            'package' => $row['interested_package'] ?? 'Not Sure',
            'package_price' => '',
            'address' => '',
            'message' => $row['message'] ?? '',
            'status' => 'new',
            'created_at' => $row['created_at'] ?? $row['saved_at'] ?? now()->toDateTimeString(),
            'raw' => $row,
        ];
    }

    protected function formatServiceOrder(array $row): array
    {
        return [
            'id' => $row['id'] ?? 0,
            'type' => 'service_agreement',
            'type_label' => 'Service Agreement Order',
            'customer_name' => $row['customer_name'] ?? $row['name'] ?? '',
            'email' => $row['email'] ?? '',
            'phone' => $row['phone'] ?? $row['mobile'] ?? '',
            'vehicle_type' => $row['vehicle_type'] ?? $row['v_type'] ?? '',
            'vehicle_no' => $row['vehicle_no'] ?? '',
            'package' => $row['interested_package'] ?? $row['pkg_description'] ?? 'Not Sure',
            'package_price' => $row['package_price'] ?? $row['pkg_price'] ?? '',
            'address' => $row['residential_address'] ?? $row['res_address'] ?? '',
            'message' => $row['message'] ?? '',
            'status' => $row['status'] ?? 'new',
            'created_at' => $row['created_at'] ?? now()->toDateTimeString(),
            'raw' => $row,
        ];
    }

    protected function arrayPaginator(array $items, int $perPage): LengthAwarePaginator
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $slice = array_slice($items, ($page - 1) * $perPage, $perPage);

        return new LengthAwarePaginator($slice, count($items), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'query' => request()->query(),
        ]);
    }
}
