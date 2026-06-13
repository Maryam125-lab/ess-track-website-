<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalyticsPageView extends Model
{
    protected $table = 'analytics_page_views';

    public $timestamps = false;

    protected $fillable = ['page_path', 'page_title', 'referrer', 'viewed_at'];

    protected $casts = ['viewed_at' => 'datetime'];
}
