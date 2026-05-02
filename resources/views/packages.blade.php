@extends('layouts.app')

@section('title', 'Vehicle Tracking Packages — ESS-TRACK BY ESSPL')

@section('content')
<!-- INNER HERO -->
<section style="background: var(--nv); padding: 160px 0 100px; color: #fff; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    <div class="wrap" style="position: relative; z-index: 2; text-align: center;">
        <div class="lbl c" style="color: var(--or);">Pricing Plans</div>
        <h1 class="ttl" style="color: #fff; margin-bottom: 20px;">Choose Your <span style="color: var(--or);">Tracking Package</span></h1>
        <p class="dsc" style="color: rgba(255,255,255,0.7); max-width: 750px; margin: 0 auto;">Select the perfect plan for your vehicle security and fleet management needs. Transparent pricing with no hidden charges.</p>
    </div>
</section>

<!-- PACKAGE TOGGLE SECTION -->
<section style="background: #f8f9fa; padding: 80px 0;">
    <div class="wrap">
        
        <!-- Toggle Switch -->
        <div style="display: flex; justify-content: center; margin-bottom: 60px;">
            <div style="background: #fff; padding: 8px; border-radius: 50px; display: flex; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #eee;">
                <button id="rentalBtn" class="toggle-btn active" onclick="showPackages('rental')">Rental Packages</button>
                <button id="deviceBtn" class="toggle-btn" onclick="showPackages('device')">With Device Packages</button>
            </div>
        </div>

        <!-- RENTAL PACKAGES GRID -->
        <div id="rentalGrid" class="pkg-grid">
            
            <!-- 1. Silver Rental -->
            <div class="pkg-card" data-aos="fade-up">
                <div class="pkg-badge">Starter</div>
                <div class="pkg-card-head">
                    <h3>Basic / Silver</h3>
                    <div class="pkg-price">PKR 14,500<span>/Total</span></div>
                </div>
                <div class="pkg-breakdown">
                    <div class="br-row"><span>VTU Unit</span><span>PKR 0</span></div>
                    <div class="br-row"><span>Installation</span><span>PKR 2,500</span></div>
                    <div class="br-row"><span>Connection Fee</span><span>PKR 1,000</span></div>
                    <div class="br-row"><span>Commissioning</span><span>PKR 1,000</span></div>
                    <div class="br-row"><span>Annual Monitoring</span><span>PKR 10,000</span></div>
                </div>
                <ul class="pkg-list">
                    <li><i class="fas fa-check"></i> 24/7 Control Room Monitoring</li>
                    <li><i class="fas fa-check"></i> Call on Geo Fence Alerts</li>
                    <li><i class="fas fa-check"></i> Vehicle Recovery Help (Police)</li>
                    <li><i class="fas fa-check"></i> System Upgrades</li>
                    <li><i class="fas fa-check"></i> Remote Vehicle Shutdown</li>
                    <li><i class="fas fa-check"></i> Data plan included</li>
                </ul>
                <a href="/contact" class="book-btn">Book Now <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 2. Gold Rental -->
            <div class="pkg-card popular" data-aos="fade-up" data-aos-delay="100">
                <div class="pkg-badge">Most Popular</div>
                <div class="pkg-card-head">
                    <h3>Standard / Gold</h3>
                    <div class="pkg-price">PKR 18,500<span>/Total</span></div>
                </div>
                <div class="pkg-breakdown">
                    <div class="br-row"><span>VTU Unit</span><span>PKR 0</span></div>
                    <div class="br-row"><span>Installation</span><span>PKR 2,500</span></div>
                    <div class="br-row"><span>Connection Fee</span><span>PKR 2,000</span></div>
                    <div class="br-row"><span>Commissioning</span><span>PKR 2,000</span></div>
                    <div class="br-row"><span>Annual Monitoring</span><span>PKR 12,000</span></div>
                </div>
                <ul class="pkg-list">
                    <li><i class="fas fa-plus"></i> All Silver Features</li>
                    <li><i class="fas fa-check"></i> European Technology Software</li>
                    <li><i class="fas fa-check"></i> Live Status on Map</li>
                    <li><i class="fas fa-check"></i> Mileage Registration</li>
                    <li><i class="fas fa-check"></i> Engine ON/OFF Alerts</li>
                    <li><i class="fas fa-check"></i> 30 Days Data Storage</li>
                    <li><i class="fas fa-check"></i> Mobile Application (FREE)</li>
                </ul>
                <a href="/contact" class="book-btn orange">Book Now <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 3. Platinum Rental -->
            <div class="pkg-card" data-aos="fade-up" data-aos-delay="200">
                <div class="pkg-badge">Advanced</div>
                <div class="pkg-card-head">
                    <h3>Premium / Platinum</h3>
                    <div class="pkg-price">PKR 35,000<span>/Total</span></div>
                </div>
                <div class="pkg-breakdown">
                    <div class="br-row"><span>VTU (Microphone)</span><span>PKR 15,500</span></div>
                    <div class="br-row"><span>Installation</span><span>PKR 2,500</span></div>
                    <div class="br-row"><span>Connection Fee</span><span>PKR 2,000</span></div>
                    <div class="br-row"><span>Commissioning</span><span>PKR 2,000</span></div>
                    <div class="br-row"><span>Annual Monitoring</span><span>PKR 13,000</span></div>
                </div>
                <ul class="pkg-list">
                    <li><i class="fas fa-plus"></i> All Gold Features</li>
                    <li><i class="fas fa-check"></i> Auto Calls Alert (Bonnet Open)</li>
                    <li><i class="fas fa-check"></i> Auto Calls Alert (Engine ON)</li>
                    <li><i class="fas fa-check"></i> Customer Access Shutdown</li>
                    <li><i class="fas fa-check"></i> Maintenance Reminders</li>
                    <li><i class="fas fa-check"></i> Dedicated Account Manager</li>
                </ul>
                <a href="/contact" class="book-btn">Book Now <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 4. Enterprise Rental -->
            <div class="pkg-card" data-aos="fade-up" data-aos-delay="300">
                <div class="pkg-badge">Bulk Fleet</div>
                <div class="pkg-card-head">
                    <h3>Corporate Fleet</h3>
                    <div class="pkg-price">PKR 18,500<span>/Vehicle</span></div>
                </div>
                <div class="pkg-breakdown">
                    <div class="br-row"><span>Multi-Vehicle Unit</span><span>PKR 0</span></div>
                    <div class="br-row"><span>Installation (On-site)</span><span>PKR 2,500</span></div>
                    <div class="br-row"><span>Service Setup</span><span>PKR 4,000</span></div>
                    <div class="br-row"><span>Annual Monitoring</span><span>PKR 12,000</span></div>
                </div>
                <ul class="pkg-list">
                    <li><i class="fas fa-check"></i> 100+ Vehicles Management</li>
                    <li><i class="fas fa-check"></i> SLA-Based Dedicated Support</li>
                    <li><i class="fas fa-check"></i> Custom Reports & Dashboards</li>
                    <li><i class="fas fa-check"></i> Priority Help Desk</li>
                    <li><i class="fas fa-check"></i> Temperature Monitoring</li>
                    <li><i class="fas fa-check"></i> Training for Staff</li>
                </ul>
                <a href="/contact" class="book-btn">Book Now <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- WITH DEVICE PACKAGES GRID (HIDDEN BY DEFAULT) -->
        <div id="deviceGrid" class="pkg-grid" style="display: none;">
            
            <!-- 1. Silver Device -->
            <div class="pkg-card">
                <div class="pkg-card-head">
                    <h3>Basic / Silver</h3>
                    <div class="pkg-price">PKR 27,000<span>/Total</span></div>
                </div>
                <div class="pkg-breakdown">
                    <div class="br-row"><span>VTU Unit</span><span>PKR 13,000</span></div>
                    <div class="br-row"><span>Battery 12v</span><span>PKR 1,500</span></div>
                    <div class="br-row"><span>Installation</span><span>PKR 2,500</span></div>
                    <div class="br-row"><span>Monitoring</span><span>PKR 8,000</span></div>
                </div>
                <ul class="pkg-list">
                    <li><i class="fas fa-check"></i> 24/7 Control Room Monitoring</li>
                    <li><i class="fas fa-check"></i> Geo Fence Alerts</li>
                    <li><i class="fas fa-check"></i> Vehicle Recovery Assistance</li>
                    <li><i class="fas fa-check"></i> Remote Vehicle Shutdown</li>
                    <li><i class="fas fa-check"></i> Data plan included</li>
                </ul>
                <a href="/contact" class="book-btn">Book Now <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 2. Gold Device -->
            <div class="pkg-card">
                <div class="pkg-card-head">
                    <h3>Standard / Gold</h3>
                    <div class="pkg-price">PKR 31,000<span>/Total</span></div>
                </div>
                <div class="pkg-breakdown">
                    <div class="br-row"><span>VTU Unit</span><span>PKR 13,000</span></div>
                    <div class="br-row"><span>Battery 12v</span><span>PKR 1,500</span></div>
                    <div class="br-row"><span>Monitoring</span><span>PKR 10,000</span></div>
                    <div class="br-row"><span>Setup Fees</span><span>PKR 6,500</span></div>
                </div>
                <ul class="pkg-list">
                    <li><i class="fas fa-plus"></i> All Silver Features</li>
                    <li><i class="fas fa-check"></i> European Technology Software</li>
                    <li><i class="fas fa-check"></i> Engine ON/OFF Alerts</li>
                    <li><i class="fas fa-check"></i> 30 Days Trip History</li>
                    <li><i class="fas fa-check"></i> Mobile App Integration</li>
                </ul>
                <a href="/contact" class="book-btn orange">Book Now <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 3. Platinum Device -->
            <div class="pkg-card">
                <div class="pkg-card-head">
                    <h3>Premium / Platinum</h3>
                    <div class="pkg-price">PKR 36,500<span>/Total</span></div>
                </div>
                <div class="pkg-breakdown">
                    <div class="br-row"><span>VTU (Microphone)</span><span>PKR 15,500</span></div>
                    <div class="br-row"><span>Battery 12v</span><span>PKR 1,500</span></div>
                    <div class="br-row"><span>Monitoring</span><span>PKR 11,000</span></div>
                    <div class="br-row"><span>Setup Fees</span><span>PKR 8,500</span></div>
                </div>
                <ul class="pkg-list">
                    <li><i class="fas fa-plus"></i> All Gold Features</li>
                    <li><i class="fas fa-check"></i> Voice Monitoring Support</li>
                    <li><i class="fas fa-check"></i> Customer Access Shutdown</li>
                    <li><i class="fas fa-check"></i> Dedicated Manager</li>
                </ul>
                <a href="/contact" class="book-btn">Book Now <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 4. Enterprise Device -->
            <div class="pkg-card">
                <div class="pkg-card-head">
                    <h3>Corporate Fleet</h3>
                    <div class="pkg-price">PKR 33,000<span>/Total</span></div>
                </div>
                <div class="pkg-breakdown">
                    <div class="br-row"><span>VTU Unit</span><span>PKR 13,000</span></div>
                    <div class="br-row"><span>Battery 12v</span><span>PKR 1,500</span></div>
                    <div class="br-row"><span>Monitoring</span><span>PKR 12,000</span></div>
                    <div class="br-row"><span>Service Setup</span><span>PKR 6,500</span></div>
                </div>
                <ul class="pkg-list">
                    <li><i class="fas fa-check"></i> 100+ Vehicles Support</li>
                    <li><i class="fas fa-check"></i> SLA-based Priority Support</li>
                    <li><i class="fas fa-check"></i> Custom API Integration</li>
                </ul>
                <a href="/contact" class="book-btn">Book Now <i class="fas fa-arrow-right"></i></a>
            </div>

            <!-- 5. Self Monitoring -->
            <div class="pkg-card">
                <div class="pkg-card-head">
                    <h3>Self-Monitoring</h3>
                    <div class="pkg-price">PKR 25,000<span>/Total</span></div>
                </div>
                <div class="pkg-breakdown">
                    <div class="br-row"><span>VTU Unit</span><span>PKR 13,000</span></div>
                    <div class="br-row"><span>Battery 12v</span><span>PKR 1,500</span></div>
                    <div class="br-row"><span>Installation</span><span>PKR 2,500</span></div>
                    <div class="br-row"><span>Annual Hosting</span><span>PKR 4,000</span></div>
                </div>
                <ul class="pkg-list">
                    <li><i class="fas fa-check"></i> Direct Mobile Control</li>
                    <li><i class="fas fa-check"></i> No Control Room Needed</li>
                    <li><i class="fas fa-check"></i> European Tech Access</li>
                    <li><i class="fas fa-check"></i> Remote Shutdown Access</li>
                </ul>
                <a href="/contact" class="book-btn">Book Now <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- Add-ons Section -->
        <div style="margin-top: 100px; text-align: center;" data-aos="fade-up">
            <h2 class="ttl">Add-on Devices & Services</h2>
            <p class="dsc" style="margin-bottom: 40px;">Customize your package with additional sensors and advanced services.</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
                <div class="add-on-box">
                    <h4>Dash Cam Tracker</h4>
                    <div class="add-on-price">PKR 45,000</div>
                    <p>Audio/Video Monitoring</p>
                </div>
                <div class="add-on-box">
                    <h4>AI Dash Cam</h4>
                    <div class="add-on-price">PKR 120,000</div>
                    <p>Advanced AI Monitoring</p>
                </div>
                <div class="add-on-box">
                    <h4>Temperature Sensor</h4>
                    <div class="add-on-price">PKR 6,500</div>
                    <p>For cold chain logistics</p>
                </div>
            </div>

            <div style="margin-top: 50px; background: #fff; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #eee;">
                <h4 style="color: var(--nv); margin-bottom: 20px;">Enterprise Custom Solutions</h4>
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; color: var(--gy); font-size: 15px;">
                    <span><i class="fas fa-cog"></i> Custom Geo Fencing</span>
                    <span><i class="fas fa-code"></i> White-label Solutions</span>
                    <span><i class="fas fa-link"></i> ERP Integration</span>
                    <span><i class="fas fa-chart-line"></i> Fleet Dashboards</span>
                </div>
                <div style="margin-top: 30px;">
                    <a href="/contact" class="bo">Request Custom Quote</a>
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
