@extends('layouts.admin')

@section('title', 'Inquiry #' . $inquiry['id'])
@section('page_title', 'Inquiry Details')

@section('content')
<a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary" style="margin-bottom:20px;"><i class="fas fa-arrow-left"></i> Back to Inquiries</a>

<div class="card">
    <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:16px;flex-wrap:wrap;margin-bottom:24px;">
        <div>
            <h2>{{ $inquiry['customer_name'] ?: 'Customer' }}</h2>
            <p class="muted">Contact Inquiry &middot; {{ date('F d, Y h:i A', strtotime($inquiry['created_at'])) }}</p>
        </div>
        <span class="badge badge-published">{{ $inquiry['package'] }}</span>
    </div>

    <div class="grid-2" style="font-size:14px;line-height:2;">
        <p><strong>First / Last Name:</strong> {{ $inquiry['customer_name'] }}</p>
        <p><strong>Phone:</strong> <a href="tel:{{ $inquiry['phone'] }}">{{ $inquiry['phone'] }}</a></p>
        <p><strong>Email:</strong> <a href="mailto:{{ $inquiry['email'] }}">{{ $inquiry['email'] }}</a></p>
        <p><strong>Car / Vehicle Type:</strong> {{ $inquiry['vehicle_type'] ?: '—' }}</p>
        <p><strong>Interested Package:</strong> {{ $inquiry['package'] }}</p>
        <p><strong>Submitted:</strong> {{ $inquiry['created_at'] }}</p>
    </div>

    <div style="margin-top:24px;">
        <h3 style="font-size:14px;margin-bottom:8px;">Customer Message</h3>
        <p style="line-height:1.8;background:#f7f8fa;padding:16px;border-radius:8px;">{{ $inquiry['message'] ?: 'No message provided.' }}</p>
    </div>

    <div style="margin-top:24px;display:flex;gap:12px;flex-wrap:wrap;">
        <a href="tel:{{ $inquiry['phone'] }}" class="btn btn-primary"><i class="fas fa-phone"></i> Call Customer</a>
        <a href="https://wa.me/92{{ ltrim(preg_replace('/[^0-9]/', '', $inquiry['phone']), '0') }}" target="_blank" class="btn btn-secondary"><i class="fab fa-whatsapp"></i> WhatsApp</a>
        <a href="mailto:{{ $inquiry['email'] }}" class="btn btn-secondary"><i class="fas fa-envelope"></i> Email</a>
    </div>
</div>
@endsection
