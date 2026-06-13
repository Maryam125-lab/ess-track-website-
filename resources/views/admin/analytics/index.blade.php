@extends('layouts.admin')
@section('title', 'Analytics')
@section('page_title', 'Website Analytics')

@section('content')

<div class="grid-2" style="grid-template-columns:repeat(4,1fr);margin-bottom:24px;">
    <div class="card" style="text-align:center;"><div style="font-size:32px;font-weight:800;color:#0d1b2a;">{{ $stats['total_views'] }}</div><div class="muted">Total Page Views</div></div>
    <div class="card" style="text-align:center;"><div style="font-size:32px;font-weight:800;color:#059669;">{{ $stats['views_today'] }}</div><div class="muted">Views Today</div></div>
    <div class="card" style="text-align:center;"><div style="font-size:32px;font-weight:800;color:#f47c20;">{{ $stats['total_orders'] }}</div><div class="muted">Service Orders</div></div>
    <div class="card" style="text-align:center;"><div style="font-size:32px;font-weight:800;color:#6366f1;">{{ $stats['total_inquiries'] }}</div><div class="muted">Contact Inquiries</div></div>
</div>

<div class="grid-2">
    <div class="card">
        <h3 style="margin-bottom:16px;">Top Pages (Most Visited)</h3>
        @forelse($stats['top_pages'] as $path => $count)
        <div style="display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px solid #f3f4f6;font-size:14px;">
            <span>/{{ $path === '/' ? '' : $path }}</span>
            <strong>{{ $count }} views</strong>
        </div>
        @empty
        <p class="muted">No data yet. Browse the website to start tracking.</p>
        @endforelse
    </div>
    <div class="card">
        <h3 style="margin-bottom:16px;">Last 7 Days Views</h3>
        @foreach($stats['views_by_day'] as $day => $count)
        <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 0;font-size:13px;">
            <span>{{ $day }}</span>
            <div style="flex:1;margin:0 12px;background:#f3f4f6;height:8px;border-radius:4px;overflow:hidden;">
                <div style="background:var(--or);height:100%;width:{{ min(100, $count * 10) }}%;"></div>
            </div>
            <strong>{{ $count }}</strong>
        </div>
        @endforeach
        <p style="margin-top:16px;font-size:13px;" class="muted"><i class="fas fa-comments"></i> Chatbot conversations: <strong>{{ $stats['total_chats'] }}</strong></p>
    </div>
</div>
@endsection
