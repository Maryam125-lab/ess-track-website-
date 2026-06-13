<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'title', 'description', 'promo_code', 'discount_type', 'discount_value',
        'badge_text', 'applies_to', 'show_on_home', 'show_on_services',
        'show_on_promo_modal', 'valid_from', 'valid_until', 'status', 'sort_order',
    ];

    protected $casts = [
        'show_on_home' => 'boolean',
        'show_on_services' => 'boolean',
        'show_on_promo_modal' => 'boolean',
        'valid_from' => 'date',
        'valid_until' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('valid_from')->orWhere('valid_from', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('valid_until')->orWhere('valid_until', '>=', now());
            })
            ->orderBy('sort_order');
    }
}
