@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('styles')
<style>
.dash-hero{background:linear-gradient(135deg,#0d1b2a 0%,#1b2f45 50%,#243447 100%);border-radius:20px;padding:32px 36px;color:#fff;margin-bottom:28px;position:relative;overflow:hidden;}
.dash-hero::after{content:'';position:absolute;top:-40px;right:-40px;width:200px;height:200px;background:rgba(244,124,32,.15);border-radius:50%;}
.dash-hero h1{font-size:26px;font-weight:800;margin-bottom:6px;position:relative;z-index:1;}
.dash-hero p{opacity:.75;font-size:14px;position:relative;z-index:1;}
.stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:28px;}
.stat-card{background:#fff;border-radius:16px;padding:22px;box-shadow:0 2px 12px rgba(0,0,0,.06);border:1px solid #f0f0f0;transition:transform .2s,box-shadow .2s;}
.stat-card:hover{transform:translateY(-3px);box-shadow:0 8px 24px rgba(0,0,0,.08);}
.stat-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:18px;margin-bottom:14px;}
.stat-val{font-size:32px;font-weight:800;line-height:1;}
.stat-lbl{font-size:12px;color:var(--gy);margin-top:6px;font-weight:500;}
.action-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;}
.action-tile{display:flex;align-items:center;gap:14px;padding:18px 20px;background:#fff;border-radius:14px;border:1px solid #eee;text-decoration:none;color:#111827;transition:all .2s;}
.action-tile:hover{border-color:var(--or);box-shadow:0 4px 16px rgba(244,124,32,.12);transform:translateY(-2px);}
.action-tile i{width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;}
.action-tile strong{display:block;font-size:14px;}
.action-tile span{font-size:11px;color:var(--gy);}
@media(max-width:1100px){.stat-grid{grid-template-columns:repeat(2,1fr);}.action-grid{grid-template-columns:1fr 1fr;}}
@media(max-width:600px){.stat-grid,.action-grid{grid-template-columns:1fr;}}
</style>
@endsection

@section('content')
<div class="dash-hero">
    <h1>Welcome back, ESS-Track Admin</h1>
    <p>Manage orders, content, promotions & website — all in one place.</p>
</div>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background:#ecfdf5;color:#059669;"><i class="fas fa-shopping-cart"></i></div>
        <div class="stat-val" style="color:#059669;">{{ $orderCount }}</div>
        <div class="stat-lbl">Service Orders</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#eef2ff;color:#6366f1;"><i class="fas fa-inbox"></i></div>
        <div class="stat-val" style="color:#6366f1;">{{ $inquiryCount }}</div>
        <div class="stat-lbl">Contact Inquiries</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fff7ed;color:#f47c20;"><i class="fas fa-newspaper"></i></div>
        <div class="stat-val" style="color:#f47c20;">{{ $blogCount }}</div>
        <div class="stat-lbl">Blog Posts</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#f0f9ff;color:#0d1b2a;"><i class="fas fa-eye"></i></div>
        <div class="stat-val" style="color:#0d1b2a;">{{ $viewsToday }}</div>
        <div class="stat-lbl">Views Today</div>
    </div>
</div>

<div class="card">
    <h2 style="margin-bottom:18px;">Quick Actions</h2>
    <div class="action-grid">
        <a href="{{ route('admin.orders.index') }}" class="action-tile"><i class="fas fa-shopping-cart" style="background:#ecfdf5;color:#059669;"></i><div><strong>Orders</strong><span>Service agreements</span></div></a>
        <a href="{{ route('admin.inquiries.index') }}" class="action-tile"><i class="fas fa-inbox" style="background:#eef2ff;color:#6366f1;"></i><div><strong>Inquiries</strong><span>Contact form leads</span></div></a>
        <a href="{{ route('admin.promotions.index') }}" class="action-tile"><i class="fas fa-tags" style="background:#fef2f2;color:#dc2626;"></i><div><strong>Promotions</strong><span>Discount codes & offers</span></div></a>
        <a href="{{ route('admin.chatbot.index') }}" class="action-tile"><i class="fas fa-robot" style="background:#f0f9ff;color:#0284c7;"></i><div><strong>Chatbot FAQ</strong><span>Customer questions</span></div></a>
        <a href="{{ route('admin.analytics.index') }}" class="action-tile"><i class="fas fa-chart-line" style="background:#fff7ed;color:#f47c20;"></i><div><strong>Analytics</strong><span>Website traffic</span></div></a>
        <a href="{{ route('admin.blog.create') }}" class="action-tile"><i class="fas fa-plus" style="background:#f7f8fa;color:#374151;"></i><div><strong>New Blog Post</strong><span>Add article</span></div></a>
        <a href="{{ route('admin.seo.index') }}" class="action-tile"><i class="fas fa-search" style="background:#f7f8fa;color:#374151;"></i><div><strong>SEO Settings</strong><span>Meta & Google</span></div></a>
        <a href="{{ route('admin.sitemap.index') }}" class="action-tile"><i class="fas fa-sitemap" style="background:#f7f8fa;color:#374151;"></i><div><strong>Sitemap</strong><span>All pages list</span></div></a>
        <a href="{{ route('home') }}" target="_blank" class="action-tile"><i class="fas fa-external-link-alt" style="background:#ecfdf5;color:#059669;"></i><div><strong>View Website</strong><span>Open live site</span></div></a>
    </div>
</div>
@endsection
