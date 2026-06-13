@extends('layouts.admin')

@section('title', 'Order #' . $order['id'])
@section('page_title', 'Order Details')

@section('content')
<a href="{{ route('admin.orders.index') }}" class="btn btn-secondary" style="margin-bottom:20px;"><i class="fas fa-arrow-left"></i> Back to Service Orders</a>

<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;margin-bottom:24px;">
        <div>
            <h2>{{ $order['customer_name'] ?: 'Customer' }}</h2>
            <p class="muted">{{ $order['type_label'] }} &middot; {{ date('F d, Y h:i A', strtotime($order['created_at'])) }}</p>
        </div>
        <span class="badge badge-published" style="font-size:13px;padding:8px 14px;">{{ $order['package'] }}</span>
    </div>

    <div class="grid-2">
        <div>
            <h3 style="font-size:14px;margin-bottom:12px;color:#374151;">Contact</h3>
            <p><strong>Phone:</strong> <a href="tel:{{ $order['phone'] }}">{{ $order['phone'] ?: '—' }}</a></p>
            <p><strong>Email:</strong> <a href="mailto:{{ $order['email'] }}">{{ $order['email'] ?: '—' }}</a></p>
        </div>
        <div>
            <h3 style="font-size:14px;margin-bottom:12px;color:#374151;">Vehicle & Package</h3>
            <p><strong>Package:</strong> {{ $order['package'] ?: 'Not Sure' }}</p>
            @if($order['package_price'])<p><strong>Package Price:</strong> PKR {{ $order['package_price'] }}</p>@endif
            @if($order['vehicle_type'])<p><strong>Vehicle Type:</strong> {{ $order['vehicle_type'] }}</p>@endif
            @if($order['vehicle_no'])<p><strong>Vehicle No:</strong> {{ $order['vehicle_no'] }}</p>@endif
        </div>
    </div>

    @if($order['address'])
    <div style="margin-top:20px;">
        <h3 style="font-size:14px;margin-bottom:8px;color:#374151;">Address</h3>
        <p>{{ $order['address'] }}</p>
    </div>
    @endif

    @if($order['message'])
    <div style="margin-top:20px;">
        <h3 style="font-size:14px;margin-bottom:8px;color:#374151;">Message</h3>
        <p style="line-height:1.7;">{{ $order['message'] }}</p>
    </div>
    @endif

    @if($order['type'] === 'service_agreement' && !empty($order['raw']))
    <div style="margin-top:24px;">
        <h3 style="font-size:14px;margin-bottom:12px;color:#374151;">Full Agreement Details</h3>
        <div class="grid-2" style="font-size:14px;line-height:2;">
            @php $raw = is_array($order['raw']['raw_payload'] ?? null) ? $order['raw']['raw_payload'] : $order['raw']; @endphp
            @foreach([
                'res_address' => 'Residential Address',
                'comm_address' => 'Commercial Address',
                'postal_code' => 'Postal Code',
                'num_home' => 'Home Phone',
                'num_office' => 'Office Phone',
                'pkg_rate' => 'Package Rate',
                'pkg_price' => 'Package Price',
                'v_type' => 'Vehicle Category',
            ] as $key => $label)
                @if(!empty($raw[$key]))
                <p><strong>{{ $label }}:</strong> {{ $raw[$key] }}</p>
                @endif
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
