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
        $stats = $analytics->summaryStats($orders);
        $contentCounts = $cms->contentCounts();

        return view('admin.dashboard', [
            'blogCount' => $contentCounts['blogs'],
            'storyCount' => $contentCounts['stories'],
            'orderCount' => $stats['total_orders'],
            'inquiryCount' => $stats['total_inquiries'],
            'viewsToday' => $stats['views_today'],
            'storageMode' => $cms->storageMode(),
        ]);
    }
}
