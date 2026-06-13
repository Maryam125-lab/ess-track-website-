<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderRepository;

class InquiryController extends Controller
{
    public function index(OrderRepository $orders)
    {
        return view('admin.inquiries.index', [
            'inquiries' => $orders->inquiries(),
        ]);
    }

    public function show(int $id, OrderRepository $orders)
    {
        $inquiry = $orders->findInquiryOnly($id);

        if (! $inquiry) {
            abort(404);
        }

        return view('admin.inquiries.show', compact('inquiry'));
    }
}
