<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CmsRepository;
use App\Services\OrderRepository;
use App\Services\AnalyticsService;

class DashboardController extends Controller
{
    public function index(CmsRepository $cms, OrderRepository $orders, AnalyticsService $analytics)
    {
        $stats = $analytics->dashboardStats($orders);

        return view('admin.dashboard', [
            'blogCount' => count($cms->allBlogPosts()),
            'storyCount' => count($cms->allSuccessStories()),
            'orderCount' => count($orders->serviceOrders()),
            'inquiryCount' => count($orders->inquiries()),
            'viewsToday' => $stats['views_today'],
            'storageMode' => $cms->storageMode(),
        ]);
    }
}
