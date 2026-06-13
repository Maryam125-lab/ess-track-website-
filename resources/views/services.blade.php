@extends('layouts.app')

@section('title', $seo['meta_title'] ?? 'Vehicle Tracking Packages — ESS-TRACK BY ESSPL')

@section('content')
@php
    $pc = fn($key, $default = '') => $pageContent[$key] ?? $default;
    $defaultPackages = [
        ['type' => 'rental', 'badge' => 'Starter', 'name' => 'Basic / Silver', 'price' => 'PKR 14,500', 'unit' => '/Total', 'popular' => false, 'breakdown' => [['VTU Unit', 'PKR 0'], ['Installation', 'PKR 2,500'], ['Connection Fee', 'PKR 1,000'], ['Commissioning', 'PKR 1,000'], ['Annual Monitoring', 'PKR 10,000']], 'features' => ['24/7 Control Room Monitoring', 'Call on Geo Fence Alerts', 'Vehicle Recovery Help (Police)', 'System Upgrades', 'Remote Vehicle Shutdown', 'Data plan included']],
        ['type' => 'rental', 'badge' => 'Most Popular', 'name' => 'Standard / Gold', 'price' => 'PKR 18,500', 'unit' => '/Total', 'popular' => true, 'breakdown' => [['VTU Unit', 'PKR 0'], ['Installation', 'PKR 2,500'], ['Connection Fee', 'PKR 2,000'], ['Commissioning', 'PKR 2,000'], ['Annual Monitoring', 'PKR 12,000']], 'features' => ['All Silver Features', 'European Technology Software', 'Live Status on Map', 'Mileage Registration', 'Engine ON/OFF Alerts', '30 Days Data Storage', 'Mobile Application (FREE)']],
        ['type' => 'rental', 'badge' => 'Advanced', 'name' => 'Premium / Platinum', 'price' => 'PKR 35,000', 'unit' => '/Total', 'popular' => false, 'breakdown' => [['VTU (Microphone)', 'PKR 15,500'], ['Installation', 'PKR 2,500'], ['Connection Fee', 'PKR 2,000'], ['Commissioning', 'PKR 2,000'], ['Annual Monitoring', 'PKR 13,000']], 'features' => ['All Gold Features', 'Auto Calls Alert (Bonnet Open)', 'Auto Calls Alert (Engine ON)', 'Customer Access Shutdown', 'Maintenance Reminders', 'Dedicated Account Manager']],
        ['type' => 'rental', 'badge' => 'Bulk Fleet', 'name' => 'Corporate Fleet', 'price' => 'PKR 18,500', 'unit' => '/Vehicle', 'popular' => false, 'breakdown' => [['Multi-Vehicle Unit', 'PKR 0'], ['Installation (On-site)', 'PKR 2,500'], ['Service Setup', 'PKR 4,000'], ['Annual Monitoring', 'PKR 12,000']], 'features' => ['100+ Vehicles Management', 'Refrigerated / Reefer Truck Solution', 'Temperature Monitoring (Real-time)', 'SLA-Based Dedicated Support', 'Custom Reports & Dashboards', 'Priority Help Desk', 'Training for Staff']],
        ['type' => 'device', 'badge' => '', 'name' => 'Basic / Silver', 'price' => 'PKR 27,000', 'unit' => '/Total', 'popular' => false, 'breakdown' => [['VTU Unit', 'PKR 13,000'], ['Battery 12v', 'PKR 1,500'], ['Installation', 'PKR 2,500'], ['Monitoring', 'PKR 8,000']], 'features' => ['24/7 Control Room Monitoring', 'Geo Fence Alerts', 'Vehicle Recovery Assistance', 'Remote Vehicle Shutdown', 'Data plan included']],
        ['type' => 'device', 'badge' => '', 'name' => 'Standard / Gold', 'price' => 'PKR 31,000', 'unit' => '/Total', 'popular' => true, 'breakdown' => [['VTU Unit', 'PKR 13,000'], ['Battery 12v', 'PKR 1,500'], ['Monitoring', 'PKR 10,000'], ['Setup Fees', 'PKR 6,500']], 'features' => ['All Silver Features', 'European Technology Software', 'Engine ON/OFF Alerts', '30 Days Trip History', 'Mobile App Integration']],
        ['type' => 'device', 'badge' => '', 'name' => 'Premium / Platinum', 'price' => 'PKR 36,500', 'unit' => '/Total', 'popular' => false, 'breakdown' => [['VTU (Microphone)', 'PKR 15,500'], ['Battery 12v', 'PKR 1,500'], ['Monitoring', 'PKR 11,000'], ['Setup Fees', 'PKR 8,500']], 'features' => ['All Gold Features', 'Voice Monitoring Support', 'Customer Access Shutdown', 'Dedicated Manager']],
        ['type' => 'device', 'badge' => '', 'name' => 'Corporate Fleet', 'price' => 'PKR 33,000', 'unit' => '/Total', 'popular' => false, 'breakdown' => [['VTU Unit', 'PKR 13,000'], ['Battery 12v', 'PKR 1,500'], ['Monitoring', 'PKR 12,000'], ['Service Setup', 'PKR 6,500']], 'features' => ['100+ Vehicles Support', 'SLA-based Priority Support', 'Custom API Integration']],
        ['type' => 'device', 'badge' => '', 'name' => 'Self-Monitoring', 'price' => 'PKR 25,000', 'unit' => '/Total', 'popular' => false, 'breakdown' => [['VTU Unit', 'PKR 13,000'], ['Battery 12v', 'PKR 1,500'], ['Installation', 'PKR 2,500'], ['Annual Hosting', 'PKR 4,000']], 'features' => ['Direct Mobile Control', 'No Control Room Needed', 'European Tech Access', 'Remote Shutdown Access']],
    ];
    $defaultAddons = [
        ['name' => 'Dash Cam Tracker', 'price' => 'PKR 45,000', 'description' => 'Audio/Video Monitoring'],
        ['name' => 'AI Dash Cam', 'price' => 'PKR 120,000', 'description' => 'Advanced AI Monitoring'],
        ['name' => 'Temperature Sensor', 'price' => 'PKR 6,500', 'description' => 'For cold chain logistics'],
    ];
    $decodedPackages = json_decode($pc('packages_json', json_encode($defaultPackages)), true);
    $decodedAddons = json_decode($pc('addons_json', json_encode($defaultAddons)), true);
    $packages = is_array($decodedPackages) && count($decodedPackages) ? $decodedPackages : $defaultPackages;
    $addons = is_array($decodedAddons) && count($decodedAddons) ? $decodedAddons : $defaultAddons;
@endphp
@include('partials.promotions-bar', ['promotions' => $servicePromotions ?? []])
<!-- INNER HERO -->
<section style="background: var(--nv); padding: 160px 0 100px; color: #fff; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    <div class="wrap" style="position: relative; z-index: 2; text-align: center;">
        <div class="lbl c" style="color: var(--or);">{{ $pc('hero_label', 'Pricing Plans') }}</div>
        <h1 class="ttl" style="color: #fff; margin-bottom: 20px;">{!! $pc('hero_title_html', 'Choose Your <span style="color: var(--or);">Tracking Package</span>') !!}</h1>
        <p class="dsc" style="color: rgba(255,255,255,0.7); max-width: 750px; margin: 0 auto;">{{ $pc('hero_description', 'Select the perfect plan for your vehicle security and fleet management needs. Transparent pricing with no hidden charges.') }}</p>
    </div>
</section>

<!-- PACKAGE TOGGLE SECTION -->
<section style="background: #f8f9fa; padding: 80px 0;">
    <div class="wrap">
        
        <!-- Toggle Switch -->
        <div style="display: flex; justify-content: center; margin-bottom: 60px;" data-aos="fade-down">
            <div style="background: #fff; padding: 8px; border-radius: 50px; display: flex; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #eee;">
                <button id="rentalBtn" class="toggle-btn active" onclick="showPackages('rental')">{{ $pc('rental_button', 'Rental Packages') }}</button>
                <button id="deviceBtn" class="toggle-btn" onclick="showPackages('device')">{{ $pc('device_button', 'With Device Packages') }}</button>
            </div>
        </div>

        <!-- RENTAL PACKAGES GRID -->
        <div id="rentalGrid" class="pkg-grid">
            @foreach(collect($packages)->where('type', 'rental')->values() as $package)
                @php
                    $packageName = $package['name'] ?? 'Package';
                    $discountName = strtolower($packageName);
                    $discountKey = str_contains($discountName, 'silver') || str_contains($discountName, 'basic') ? 'silver' : (str_contains($discountName, 'gold') || str_contains($discountName, 'standard') ? 'gold' : (str_contains($discountName, 'platinum') || str_contains($discountName, 'premium') ? 'platinum' : (str_contains($discountName, 'fleet') || str_contains($discountName, 'corporate') ? 'fleet' : null)));
                    $bookingName = $packageName . ' Rental';
                    $breakdown = is_array($package['breakdown'] ?? null) ? $package['breakdown'] : [];
                    $features = is_array($package['features'] ?? null) ? $package['features'] : [];
                @endphp
                <div class="pkg-card {{ !empty($package['popular']) ? 'popular' : '' }}" data-aos="fade-up" onclick="openBookingModal(@js($bookingName))" style="position:relative;">
                    @include('partials.package-discount', ['promo' => $discountKey ? ($packageDiscounts[$discountKey] ?? null) : null])
                    @if(!empty($package['badge']))<div class="pkg-badge">{{ $package['badge'] }}</div>@endif
                    <div class="pkg-card-head">
                        <h3>{{ $packageName }}</h3>
                        <div class="pkg-price">{{ $package['price'] ?? '' }}<span>{{ $package['unit'] ?? '' }}</span></div>
                    </div>
                    @if($breakdown)
                        <div class="pkg-breakdown">
                            @foreach($breakdown as $row)
                                <div class="br-row"><span>{{ $row[0] ?? '' }}</span><span>{{ $row[1] ?? '' }}</span></div>
                            @endforeach
                        </div>
                    @endif
                    @if($features)
                        <ul class="pkg-list">
                            @foreach($features as $feature)
                                <li><i class="fas fa-check"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <button class="book-btn {{ !empty($package['popular']) ? 'orange' : '' }}" style="border:none; width:100%;">Book Now <i class="fas fa-arrow-right"></i></button>
                </div>
            @endforeach
        </div>

        <!-- WITH DEVICE PACKAGES GRID (HIDDEN BY DEFAULT) -->
        <div id="deviceGrid" class="pkg-grid" style="display: none;">
            @foreach(collect($packages)->where('type', 'device')->values() as $package)
                @php
                    $packageName = $package['name'] ?? 'Package';
                    $bookingName = $packageName . ' Device';
                    $breakdown = is_array($package['breakdown'] ?? null) ? $package['breakdown'] : [];
                    $features = is_array($package['features'] ?? null) ? $package['features'] : [];
                @endphp
                <div class="pkg-card {{ !empty($package['popular']) ? 'popular' : '' }}" onclick="openBookingModal(@js($bookingName))" style="position:relative;">
                    @if(!empty($package['badge']))<div class="pkg-badge">{{ $package['badge'] }}</div>@endif
                    <div class="pkg-card-head">
                        <h3>{{ $packageName }}</h3>
                        <div class="pkg-price">{{ $package['price'] ?? '' }}<span>{{ $package['unit'] ?? '' }}</span></div>
                    </div>
                    @if($breakdown)
                        <div class="pkg-breakdown">
                            @foreach($breakdown as $row)
                                <div class="br-row"><span>{{ $row[0] ?? '' }}</span><span>{{ $row[1] ?? '' }}</span></div>
                            @endforeach
                        </div>
                    @endif
                    @if($features)
                        <ul class="pkg-list">
                            @foreach($features as $feature)
                                <li><i class="fas fa-check"></i> {{ $feature }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <button class="book-btn {{ !empty($package['popular']) ? 'orange' : '' }}" style="border:none; width:100%;">Book Now <i class="fas fa-arrow-right"></i></button>
                </div>
            @endforeach
        </div>
        <!-- Add-ons Section -->
        <div style="margin-top: 100px; text-align: center;" data-aos="fade-up">
            <h2 class="ttl">Add-on Devices & Services</h2>
            <p class="dsc" style="margin-bottom: 40px;">Customize your package with additional sensors and advanced services.</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
                @foreach($addons as $addon)
                    @php $addonName = $addon['name'] ?? 'Add-on'; @endphp
                    <div class="add-on-box" onclick="openBookingModal(@js($addonName . ' Add-on'))">
                        <h4>{{ $addonName }}</h4>
                        <div class="add-on-price">{{ $addon['price'] ?? '' }}</div>
                        <p>{{ $addon['description'] ?? '' }}</p>
                    </div>
                @endforeach
            </div>

            <div style="margin-top: 50px; background: #fff;' padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #eee;">
                <h4 style="color: var(--nv); margin-bottom: 20px;">{{ $pc('custom_title', 'Enterprise Custom Solutions') }}</h4>
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; color: var(--gy); font-size: 15px;">
                    <span><i class="fas fa-cog"></i> Custom Geo Fencing</span>
                    <span><i class="fas fa-code"></i> White-label Solutions</span>
                    <span><i class="fas fa-link"></i> ERP Integration</span>
                    <span><i class="fas fa-chart-line"></i> Fleet Dashboards</span>
                </div>
                <div style="margin-top: 30px;">
                    <a href="/contact" class="bo">{{ $pc('custom_button', 'Request Custom Quote') }}</a>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
    .toggle-btn {
        padding: 12px 35px;
        border: none;
        background: transparent;
        color: var(--gy);
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        border-radius: 50px;
        transition: all 0.3s;
    }
    .toggle-btn.active {
        background: var(--nv);
        color: #fff;
        box-shadow: 0 5px 15px rgba(13, 27, 42, 0.2);
    }
    .pkg-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }
    .pkg-card {
        background: #fff;
        padding: 40px 30px;
        border-radius: 30px;
        border: 1px solid #eee;
        position: relative;
        transition: all 0.4s;
        display: flex;
        flex-direction: column;
    }
    .pkg-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.08);
        border-color: var(--or);
    }
    .pkg-card.popular {
        border: 2px solid var(--or);
        box-shadow: 0 30px 60px rgba(244, 124, 32, 0.1);
    }
    .pkg-badge {
        position: absolute;
        top: 20px;
        right: 25px;
        background: var(--of);
        color: var(--nv);
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .pkg-card.popular .pkg-badge {
        background: var(--or);
        color: #fff;
    }
    .pkg-card-head h3 {
        font-size: 22px;
        color: var(--nv);
        margin-bottom: 10px;
    }
    .pkg-price {
        font-size: 32px;
        font-weight: 900;
        color: var(--nv);
        margin-bottom: 25px;
    }
    .pkg-price span {
        font-size: 14px;
        color: var(--gy);
        font-weight: 600;
    }
    .pkg-breakdown {
        background: #fcfcfc;
        padding: 15px;
        border-radius: 15px;
        margin-bottom: 25px;
        border: 1px dashed #eee;
    }
    .br-row {
        display: flex;
        justify-content: space-between;
        font-size: 12px;
        margin-bottom: 5px;
        color: var(--gy);
    }
    .br-row span:last-child {
        font-weight: 700;
        color: var(--nv);
    }
    .pkg-list {
        list-style: none;
        padding: 0;
        margin: 0 0 30px 0;
        flex: 1;
    }
    .pkg-list li {
        font-size: 14px;
        color: var(--gy);
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .pkg-list li i {
        color: var(--or);
        font-size: 12px;
    }
    .book-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: var(--nv);
        color: #fff;
        text-decoration: none;
        padding: 15px;
        border-radius: 15px;
        font-weight: 700;
        transition: all 0.3s;
    }
    .book-btn.orange {
        background: var(--or);
    }
    .book-btn:hover {
        background: #000;
        color: #fff;
    }
    .add-on-box {
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        border: 1px solid #eee;
        transition: all 0.3s;
    }
    .add-on-box:hover {
        border-color: var(--or);
        background: #fffaf7;
    }
    .add-on-box h4 {
        margin-bottom: 10px;
        color: var(--nv);
    }
    .add-on-price {
        font-size: 24px;
        font-weight: 800;
        color: var(--or);
        margin-bottom: 5px;
    }
</style>

<script>
    function showPackages(type) {
        const rentalGrid = document.getElementById('rentalGrid');
        const deviceGrid = document.getElementById('deviceGrid');
        const rentalBtn = document.getElementById('rentalBtn');
        const deviceBtn = document.getElementById('deviceBtn');

        if (type === 'rental') {
            rentalGrid.style.display = 'grid';
            deviceGrid.style.display = 'none';
            rentalBtn.classList.add('active');
            deviceBtn.classList.remove('active');
        } else {
            rentalGrid.style.display = 'none';
            deviceGrid.style.display = 'grid';
            rentalBtn.classList.remove('active');
            deviceBtn.classList.add('active');
        }
    }
</script>
@endsection
