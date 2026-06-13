<?php

namespace App\Services;

use App\Models\Promotion;

class PromotionRepository
{
    private static ?array $cache = null;

    public function all(): array
    {
        if (self::$cache !== null) {
            return self::$cache;
        }

        if (CmsStorage::usesDatabase() && $this->hasTable('promotions')) {
            return self::$cache = Promotion::orderBy('sort_order')->get()->toArray();
        }

        return self::$cache = CmsStorage::readJson()['promotions'] ?? [];
    }

    public function forPackage(string $tier, ?array $promotions = null): ?array
    {
        $promotions = $promotions ?? $this->activeFor('services');
        $map = [
            'silver' => ['all', 'basic', 'silver'],
            'gold' => ['all', 'gold', 'silver'],
            'platinum' => ['all', 'gold', 'tracker'],
            'fleet' => ['all'],
        ];

        foreach ($promotions as $promo) {
            if (in_array($promo['applies_to'] ?? 'all', $map[$tier] ?? ['all'], true)) {
                return $promo;
            }
        }

        return null;
    }

    public function activeFor(string $location): array
    {
        $key = 'show_on_' . $location;

        return collect($this->all())->filter(function ($p) use ($key) {
            if (($p['status'] ?? '') !== 'active') {
                return false;
            }
            if (! ($p[$key] ?? false)) {
                return false;
            }
            if (! empty($p['valid_from']) && strtotime($p['valid_from']) > time()) {
                return false;
            }
            if (! empty($p['valid_until']) && strtotime($p['valid_until']) < time()) {
                return false;
            }

            return true;
        })->sortBy('sort_order')->values()->all();
    }

    public function findById(int $id): ?array
    {
        foreach ($this->all() as $item) {
            if ((int) ($item['id'] ?? 0) === $id) {
                return $item;
            }
        }

        return null;
    }

    public function save(array $data, ?int $id = null): array
    {
        $data['show_on_home'] = ! empty($data['show_on_home']);
        $data['show_on_services'] = ! empty($data['show_on_services']);
        $data['show_on_promo_modal'] = ! empty($data['show_on_promo_modal']);

        if (CmsStorage::usesDatabase() && $this->hasTable('promotions')) {
            if ($id) {
                $row = Promotion::findOrFail($id);
                $row->update($data);

                self::$cache = null;

                return $row->fresh()->toArray();
            }

            self::$cache = null;

            return Promotion::create($data)->toArray();
        }

        $store = CmsStorage::readJson();
        $items = $store['promotions'] ?? [];

        if ($id) {
            foreach ($items as $i => $item) {
                if ((int) ($item['id'] ?? 0) === $id) {
                    $items[$i] = array_merge($item, $data, ['id' => $id]);
                    $store['promotions'] = $items;
                    CmsStorage::writeJson($store);
                    self::$cache = null;

                    return $items[$i];
                }
            }
        }

        $newId = (collect($items)->max('id') ?? 0) + 1;
        $new = array_merge($data, ['id' => $newId]);
        $items[] = $new;
        $store['promotions'] = $items;
        CmsStorage::writeJson($store);
        self::$cache = null;

        return $new;
    }

    public function delete(int $id): void
    {
        if (CmsStorage::usesDatabase() && $this->hasTable('promotions')) {
            Promotion::destroy($id);
            self::$cache = null;

            return;
        }

        $store = CmsStorage::readJson();
        $store['promotions'] = array_values(array_filter(
            $store['promotions'] ?? [],
            fn ($p) => (int) ($p['id'] ?? 0) !== $id
        ));
        CmsStorage::writeJson($store);
        self::$cache = null;
    }

    protected function hasTable(string $table): bool
    {
        try {
            return \Illuminate\Support\Facades\Schema::hasTable($table);
        } catch (\Throwable $e) {
            return false;
        }
    }
}
