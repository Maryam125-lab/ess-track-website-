@extends('layouts.admin')

@section('title', 'Orders')
@section('page_title', 'Service Orders')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h2>Service Agreement Orders</h2>
        <p class="muted">Customers who signed & placed order via booking modal (package selected)</p>
    </div>
    <span class="badge badge-published">{{ count($orders) }} Total</span>
</div>

<div class="card" style="padding:0;overflow:hidden;">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Car Type</th>
                <th>Vehicle No</th>
                <th>Package</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ date('M d, Y h:i A', strtotime($order['created_at'])) }}</td>
                <td>
                    <strong>{{ $order['customer_name'] ?: '—' }}</strong><br>
                    <span class="muted">{{ $order['email'] }}</span>
                </td>
                <td><a href="tel:{{ $order['phone'] }}" style="color:var(--or);text-decoration:none;font-weight:600;">{{ $order['phone'] ?: '—' }}</a></td>
                <td>{{ $order['vehicle_type'] ?: '—' }}</td>
                <td>{{ $order['vehicle_no'] ?: '—' }}</td>
                <td><span class="badge badge-published">{{ $order['package'] ?: 'Not Sure' }}</span></td>
                <td>
                    <a href="{{ route('admin.orders.show', $order['id']) }}" class="btn btn-secondary" style="padding:6px 12px;font-size:12px;">View Details</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;padding:50px;" class="muted">
                    No service orders yet. When a customer completes the service agreement form, it will appear here.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
