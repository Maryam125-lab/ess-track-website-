<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') — ESS-Track CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root{--nv:#0d1b2a;--or:#f47c20;--lt:#f7f8fa;--gy:#6b7280;--ok:#059669;--err:#dc2626;}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Segoe UI',system-ui,-apple-system,sans-serif;background:var(--lt);color:#111827;min-height:100vh;overflow-x:hidden;}
        .admin-wrap{display:flex;min-height:100vh;}
        .sidebar{width:260px;background:var(--nv);color:#fff;padding:24px 0;flex-shrink:0;}
        .sidebar .brand{padding:0 24px 24px;border-bottom:1px solid rgba(255,255,255,.1);margin-bottom:16px;}
        .sidebar .brand h1{font-size:18px;font-weight:800;}
        .sidebar .brand p{font-size:11px;color:var(--or);letter-spacing:2px;text-transform:uppercase;margin-top:4px;}
        .sidebar nav a{display:flex;align-items:center;gap:12px;padding:12px 24px;color:rgba(255,255,255,.75);text-decoration:none;font-size:14px;transition:.2s;}
        .sidebar nav a:hover,.sidebar nav a.active{background:rgba(244,124,32,.15);color:#fff;border-right:3px solid var(--or);}
        .main{flex:1;display:flex;flex-direction:column;}
        .topbar{background:#fff;border-bottom:1px solid #e5e7eb;padding:16px 32px;display:flex;justify-content:space-between;align-items:center;}
        .content{padding:32px;flex:1;}
        .card{background:#fff;border-radius:12px;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,.08);margin-bottom:24px;}
        h2{font-size:22px;font-weight:700;margin-bottom:8px;}
        .muted{color:var(--gy);font-size:13px;}
        .alert{padding:12px 16px;border-radius:8px;margin-bottom:20px;font-size:14px;}
        .alert-success{background:#d1fae5;color:#065f46;}
        .alert-error{background:#fee2e2;color:#991b1b;}
        .btn{display:inline-flex;align-items:center;gap:8px;padding:10px 18px;border-radius:8px;font-size:14px;font-weight:600;border:none;cursor:pointer;text-decoration:none;font-family:inherit;}
        .btn-primary{background:var(--or);color:#fff;}
        .btn-primary:hover{background:#d96a10;}
        .btn-secondary{background:#e5e7eb;color:#374151;}
        .btn-danger{background:#fee2e2;color:var(--err);}
        table{width:100%;border-collapse:collapse;}
        th,td{padding:12px;text-align:left;border-bottom:1px solid #f3f4f6;font-size:14px;}
        th{font-weight:600;color:var(--gy);font-size:12px;text-transform:uppercase;}
        .badge{padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;}
        .badge-published{background:#d1fae5;color:#065f46;}
        .badge-draft{background:#fef3c7;color:#92400e;}
        .form-group{margin-bottom:18px;}
        label{display:block;font-size:13px;font-weight:600;margin-bottom:6px;color:#374151;}
        input,textarea,select{width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-family:inherit;font-size:14px;}
        textarea{min-height:120px;resize:vertical;}
        .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
        @media(max-width:900px){
            .admin-wrap{flex-direction:column;}
            .sidebar{width:100%;padding:14px 0 10px;position:sticky;top:0;z-index:50;box-shadow:0 8px 24px rgba(13,27,42,.18);}
            .sidebar .brand{padding:0 16px 12px;margin-bottom:10px;}
            .sidebar .brand h1{font-size:17px;}
            .sidebar .brand p{font-size:10px;}
            .sidebar nav{display:flex;gap:8px;overflow-x:auto;padding:0 12px 4px;scrollbar-width:thin;}
            .sidebar nav a{flex:0 0 auto;border:1px solid rgba(255,255,255,.12);border-radius:999px;padding:9px 12px;font-size:13px;white-space:nowrap;}
            .sidebar nav a:hover,.sidebar nav a.active{border-right:none;border-color:rgba(244,124,32,.55);}
            .sidebar nav form{flex:0 0 auto;margin:0 !important;padding:0 !important;}
            .sidebar nav form .btn{height:38px;white-space:nowrap;}
            .topbar{position:sticky;top:0;z-index:40;padding:12px 16px;gap:8px;flex-wrap:wrap;}
            .content{padding:18px 14px;}
            .card{padding:18px;border-radius:10px;margin-bottom:18px;overflow-x:auto;}
            .grid-2{grid-template-columns:1fr !important;}
            table{display:block;overflow-x:auto;white-space:nowrap;-webkit-overflow-scrolling:touch;}
            th,td{padding:10px;font-size:13px;}
            .btn{padding:9px 13px;font-size:13px;}
            input,textarea,select{font-size:16px;}
        }

        @media(max-width:560px){
            .topbar{align-items:flex-start;}
            .topbar .muted{font-size:12px;overflow-wrap:anywhere;}
            .content{padding:14px 10px;}
            .card{padding:15px;}
            h2{font-size:19px;}
            .sidebar nav a{font-size:12px;padding:8px 10px;}
        }
    </style>
    @yield('styles')
</head>
<body>
<div class="admin-wrap">
    @if(session('admin_authenticated'))
    <aside class="sidebar">
        <div class="brand">
            <h1>ESS-Track CMS</h1>
            <p>Admin Portal</p>
        </div>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-gauge"></i> Dashboard</a>
            <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"><i class="fas fa-shopping-cart"></i> Orders</a>
            <a href="{{ route('admin.inquiries.index') }}" class="{{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}"><i class="fas fa-inbox"></i> Inquiries</a>
            <a href="{{ route('admin.promotions.index') }}" class="{{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}"><i class="fas fa-tags"></i> Promotions</a>
            <a href="{{ route('admin.blog.index') }}" class="{{ request()->routeIs('admin.blog.*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> Blog Posts</a>
            <a href="{{ route('admin.success-stories.index') }}" class="{{ request()->routeIs('admin.success-stories.*') ? 'active' : '' }}"><i class="fas fa-trophy"></i> Success Stories</a>
            <a href="{{ route('admin.chatbot.index') }}" class="{{ request()->routeIs('admin.chatbot.*') ? 'active' : '' }}"><i class="fas fa-robot"></i> Chatbot FAQ</a>
            <a href="{{ route('admin.analytics.index') }}" class="{{ request()->routeIs('admin.analytics.*') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Analytics</a>
            <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}"><i class="fas fa-pen-to-square"></i> Page Content</a>
            <a href="{{ route('admin.sitemap.index') }}" class="{{ request()->routeIs('admin.sitemap.*') ? 'active' : '' }}"><i class="fas fa-sitemap"></i> Sitemap</a>
            <a href="{{ route('admin.seo.index') }}" class="{{ request()->routeIs('admin.seo.*') ? 'active' : '' }}"><i class="fas fa-search"></i> SEO Settings</a>
            <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"><i class="fas fa-cog"></i> Site Settings</a>
            <a href="{{ route('home') }}" target="_blank"><i class="fas fa-external-link-alt"></i> View Website</a>
            <form action="{{ route('admin.logout') }}" method="POST" style="margin-top:20px;padding:0 24px;">
                @csrf
                <button type="submit" class="btn btn-secondary" style="width:100%;justify-content:center;"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </nav>
    </aside>
    @endif
    <div class="main">
        @if(session('admin_authenticated'))
        <div class="topbar">
            <div><strong>@yield('page_title', 'Dashboard')</strong></div>
            <span class="muted">{{ session('admin_email') }}</span>
        </div>
        @endif
        <div class="content">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="alert alert-error">{{ session('error') }}</div>@endif
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
