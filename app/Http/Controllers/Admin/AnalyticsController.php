<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AnalyticsService;
use App\Services\OrderRepository;

class AnalyticsController extends Controller
{
    public function index(AnalyticsService $analytics, OrderRepository $orders)
    {
        return view('admin.analytics.index', [
            'stats' => $analytics->dashboardStats($orders),
        ]);
    }
}
