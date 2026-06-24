<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderRepository;

class OrderController extends Controller
{
    public function index(OrderRepository $orders)
    {
        return view('admin.orders.index', [
            'orders' => $orders->serviceOrders(),
        ]);
    }

    public function show(int $id, OrderRepository $orders)
    {
        $order = $orders->findOrderOnly($id);

        if (! $order) {
            abort(404);
        }

        return view('admin.orders.show', compact('order'));
    }
}
