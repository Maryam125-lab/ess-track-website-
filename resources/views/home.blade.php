@extends('layouts.app')

@section('title', 'Home — ESS-TRACK BY ESSPL')
@section('content')
<!-- HERO SECTION -->
<section style="position: relative; overflow: hidden; min-height: 100vh; display: flex; align-items: center;">
    <!-- Background Video -->
    <div id="videoSlider" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 0; overflow: hidden;">
        <video autoplay muted loop playsinline class="hero-video active" id="video1" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: opacity 1.5s ease-in-out; opacity: 1; object-position: center top;">
            <source src="{{ asset('images/hero-video.mp4') }}" type="video/mp4">
        </video>
    </div>
    
    <!-- Dark Overlay -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(135deg, rgba(13,27,42,0.85) 0%, rgba(13,27,42,0.7) 50%, rgba(244,124,32,0.15) 100%); z-index: 1;"></div>

    <div id="heroContent" class="wrap" style="display: flex; align-items: center; gap: 50px; position: relative; z-index: 3; padding-top: 140px; padding-bottom: 100px; width: 100%;">
        <div style="flex: 1.2;" data-aos="fade-right">
            <div class="lbl" style="color: var(--or);">Expert Tracking Solutions</div>
            <h1 class="ttl" style="margin-bottom: 22px; color: #fff; font-size: clamp(32px, 4vw, 54px);">Precision <span style="color:var(--or);">Vehicle Tracking</span> System Expert</h1>
            <p class="dsc" style="margin-bottom: 40px; font-size: 17px; color: rgba(255,255,255,0.75); max-width: 550px;">ESS-TRACK BY ESSPL provides state-of-the-art surveillance and tracking facilities across Pakistan, utilizing advanced 3G-2G communication platforms.</p>
            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <a href="{{ route('tracker') }}" class="bo" style="padding: 16px 32px; font-size: 15px;">View Tracker <i class="fas fa-arrow-right"></i></a>
                <a href="{{ route('services') }}" class="bw-white" style="padding: 15px 30px; font-size: 15px; display: inline-flex; align-items: center; gap: 9px; border-radius: 8px; text-decoration: none; font-family: 'Poppins', sans-serif; font-weight: 600; cursor: pointer; transition: all .25s;">Our Packages</a>
            </div>
            
            <div style="margin-top: 55px; display: flex; gap: 40px; align-items: center;">
                <div>
                    <div style="font-size: 32px; font-weight: 800; color: #fff; line-height: 1;">15+</div>
                    <div style="font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 1.5px; margin-top: 6px;">Years Exp</div>
                </div>
                <div style="width: 1px; height: 40px; background: rgba(255,255,255,.15);"></div>
                <div>
                    <div style="font-size: 32px; font-weight: 800; color: #fff; line-height: 1;">50k+</div>
                    <div style="font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 1.5px; margin-top: 6px;">Tracked</div>
                </div>
                <div style="width: 1px; height: 40px; background: rgba(255,255,255,.15);"></div>
                <div>
                    <div style="font-size: 32px; font-weight: 800; color: #fff; line-height: 1;">24/7</div>
                    <div style="font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 1.5px; margin-top: 6px;">Support</div>
                </div>
            </div>
        </div>
        <div style="flex: 0.8; display: flex; justify-content: flex-end;" data-aos="fade-left">
            <div style="position: relative; width: 100%; max-width: 420px;">
                <!-- Floating Info Card -->
                <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.15); padding: 30px; border-radius: 24px; box-shadow: 0 30px 60px rgba(0,0,0,0.25);" data-aos="zoom-in" data-aos-delay="300">
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                        <div style="width: 50px; height: 50px; background: rgba(244,124,32,0.2); color: var(--or); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px;"><i class="fas fa-shield-check"></i></div>
                        <div>
                            <div style="font-size: 16px; font-weight: 800; color: #fff; line-height: 1.2;">Secure System</div>
                            <div style="font-size: 12px; color: rgba(255,255,255,0.5); font-weight: 500;">PTA & SECP Licensed</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 25px;">
                        <div style="width: 50px; height: 50px; background: rgba(37,211,102,0.15); color: #25d366; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px;"><i class="fas fa-location-crosshairs"></i></div>
                        <div>
                            <div style="font-size: 16px; font-weight: 800; color: #fff; line-height: 1.2;">Live Tracking</div>
                            <div style="font-size: 12px; color: rgba(255,255,255,0.5); font-weight: 500;">Real-Time GPS Monitoring</div>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div style="width: 50px; height: 50px; background: rgba(59,130,246,0.15); color: #3b82f6; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 22px;"><i class="fas fa-headset"></i></div>
                        <div>
                            <div style="font-size: 16px; font-weight: 800; color: #fff; line-height: 1.2;">24/7 Support</div>
                            <div style="font-size: 12px; color: rgba(255,255,255,0.5); font-weight: 500;">Always Available For You</div>
                        </div>
                    </div>
                </div>
                <!-- Floating Badge -->
                <div style="position: absolute; top: -15px; right: -15px; background: var(--or); color: #fff; padding: 14px 22px; border-radius: 14px; font-weight: 700; font-size: 14px; box-shadow: 0 10px 25px rgba(244,124,32,0.4);" data-aos="zoom-in" data-aos-delay="600">
                    <i class="fas fa-star" style="margin-right: 6px;"></i> Top Rated
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bottom scroll indicator -->
    <div style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%); z-index: 3; text-align: center; animation: bounceDown 2s infinite;">
        <div style="width: 30px; height: 50px; border: 2px solid rgba(255,255,255,0.3); border-radius: 15px; display: flex; justify-content: center; padding-top: 8px;">
            <div style="width: 4px; height: 12px; background: var(--or); border-radius: 2px; animation: scrollDot 2s infinite;"></div>
        </div>
    </div>
</section>

<!-- CORE FEATURES -->
<section style="background: #fff; padding-bottom: 120px;">
    <div class="wrap">
        <div class="tc" style="margin-bottom: 70px;" data-aos="fade-up">
            <div class="lbl c">Advanced Capabilities</div>
            <h2 class="ttl">Premium Tracking Features</h2>
            <p class="dsc">Our ecosystem is built to give you total control and peace of mind with enterprise-grade security.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 35px;">
            <!-- Feature 1 -->
            <div class="hover-lift" style="padding: 45px; border-radius: 24px; background: var(--of); border: 1px solid rgba(0,0,0,.04); transition: all 0.3s ease;" data-aos="fade-up" data-aos-delay="100">
                <div style="width: 65px; height: 65px; background: #fff; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 28px; color: var(--or); margin-bottom: 25px; box-shadow: 0 10px 20px rgba(0,0,0,0.04);"><i class="fas fa-location-crosshairs"></i></div>
                <h3 style="font-size: 20px; font-weight: 800; color: var(--nv); margin-bottom: 15px;">Real-Time Tracking</h3>
                <p style="font-size: 15px; color: var(--gy); line-height: 1.8;">Get pinpoint accuracy of your vehicle's location on live maps with 24/7 monitoring capabilities.</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="hover-lift" style="padding: 45px; border-radius: 24px; background: var(--of); border: 1px solid rgba(0,0,0,.04); transition: all 0.3s ease;" data-aos="fade-up" data-aos-delay="200">
                <div style="width: 65px; height: 65px; background: #fff; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 28px; color: var(--or); margin-bottom: 25px; box-shadow: 0 10px 20px rgba(0,0,0,0.04);"><i class="fas fa-bell"></i></div>
                <h3 style="font-size: 20px; font-weight: 800; color: var(--nv); margin-bottom: 15px;">Proactive Alerts</h3>
                <p style="font-size: 15px; color: var(--gy); line-height: 1.8;">Immediate notifications for battery tampering, ignition status, and geofence boundary crossings.</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="hover-lift" style="padding: 45px; border-radius: 24px; background: var(--of); border: 1px solid rgba(0,0,0,.04); transition: all 0.3s ease;" data-aos="fade-up" data-aos-delay="300">
                <div style="width: 65px; height: 65px; background: #fff; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 28px; color: var(--or); margin-bottom: 25px; box-shadow: 0 10px 20px rgba(0,0,0,0.04);"><i class="fas fa-history"></i></div>
                <h3 style="font-size: 20px; font-weight: 800; color: var(--nv); margin-bottom: 15px;">Detailed History</h3>
                <p style="font-size: 15px; color: var(--gy); line-height: 1.8;">Access 90 days of route history with speed analysis, stop duration, and trip reports.</p>
            </div>
        </div>
    </div>
</section>

<!-- CALL CENTER / SUPPORT -->
<section style="background: var(--nv); color: #fff; padding: 100px 0; overflow: hidden; position: relative;">
    <div style="position: absolute; top: 0; right: 0; width: 40%; height: 100%; background: linear-gradient(to left, rgba(244,124,32,0.05), transparent);"></div>
    <div class="wrap">
        <div style="display: flex; align-items: center; gap: 60px; flex-wrap: wrap;">
            <div style="flex: 1.2;" data-aos="fade-right">
                <div class="lbl" style="color: var(--or);">24/7 Command Center</div>
                <h2 class="ttl" style="color: #fff; margin-bottom: 25px;">Always Guarding <br>What Matters To You</h2>
                <p class="dsc" style="color: rgba(255,255,255,0.7); margin-bottom: 35px;">Our dedicated support team is always ready. In case of any violation or theft attempt, we reach out to you immediately to ensure your vehicle's safety.</p>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-check-circle" style="color: var(--or);"></i>
                        <span style="font-size: 15px; font-weight: 500;">Battery Tampering</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-check-circle" style="color: var(--or);"></i>
                        <span style="font-size: 15px; font-weight: 500;">Zone Violations</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-check-circle" style="color: var(--or);"></i>
                        <span style="font-size: 15px; font-weight: 500;">Theft Recovery</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <i class="fas fa-check-circle" style="color: var(--or);"></i>
                        <span style="font-size: 15px; font-weight: 500;">Call Center Support</span>
                    </div>
                </div>
                
                <a href="tel:02134330887" class="bo">Contact Our Center <i class="fas fa-headset" style="margin-left: 8px;"></i></a>
            </div>
            <div style="flex: 0.8;" data-aos="fade-left">
                <div class="glass-card" style="padding: 45px 40px; border-radius: 30px; text-align: center; box-shadow: 0 25px 50px rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1);">
                    <div style="font-size: 54px; color: var(--or); margin-bottom: 25px; filter: drop-shadow(0 0 15px rgba(244,124,32,0.3));"><i class="fas fa-phone-volume"></i></div>
                    <h4 style="font-size: 24px; margin-bottom: 12px; font-weight: 700; color: #fff;">Emergency Hotline</h4>
                    <p style="color: rgba(255,255,255,0.6); font-size: 15px; margin-bottom: 30px; font-weight: 300;">Call us anytime for instant support</p>
                    <div style="font-size: 32px; font-weight: 800; color: #fff; letter-spacing: 1px; text-shadow: 0 2px 10px rgba(0,0,0,0.3);">021-34330887</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MOBILE APP PROMO -->
<section style="background: #fff; padding-top: 120px;">
    <div class="wrap">
        <div style="background: var(--lt); border-radius: 40px; padding: 60px; display: flex; align-items: center; gap: 60px; flex-wrap: wrap-reverse;">
            <div style="flex: 0.7; text-align: center;" data-aos="fade-up">
                <img src="{{ asset('images/app-interface.png') }}" alt="App Interface" style="max-width: 100%; border-radius: 30px; box-shadow: 0 30px 60px rgba(13, 27, 42, 0.25); border: 8px solid #fff;">
            </div>
            <div style="flex: 1.3;" data-aos="fade-left">
                <div class="lbl">Mobile Control</div>
                <h2 class="ttl">Track Your Vehicle <br>On The Go</h2>
                <p class="dsc" style="margin-bottom: 35px;">Download our mobile application to get real-time location, speed reports, and instant notifications right in your pocket. Compatible with Android & iOS.</p>
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <a href="https://play.google.com/store/apps/details?id=com.esspl.tracking&hl=en" target="_blank" style="padding: 12px 24px; background: #000; color: #fff; border-radius: 12px; display: flex; align-items: center; gap: 12px; cursor: pointer; text-decoration: none;" class="hover-lift">
                        <i class="fab fa-apple" style="font-size: 28px;"></i>
                        <div style="text-align: left;">
                            <div style="font-size: 10px; opacity: 0.7;">Download on</div>
                            <div style="font-size: 15px; font-weight: 700;">App Store</div>
                        </div>
                    </a>
                    <a href="https://play.google.com/store/apps/details?id=com.esspl.tracking&hl=en" target="_blank" style="padding: 12px 24px; background: #000; color: #fff; border-radius: 12px; display: flex; align-items: center; gap: 12px; cursor: pointer; text-decoration: none;" class="hover-lift">
                        <i class="fab fa-google-play" style="font-size: 24px;"></i>
                        <div style="text-align: left;">
                            <div style="font-size: 10px; opacity: 0.7;">Get it on</div>
                            <div style="font-size: 15px; font-weight: 700;">Google Play</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FINAL CTA -->
<section style="background: #fff; padding: 120px 0;">
    <div class="wrap tc">
        <div data-aos="zoom-in">
            <h2 class="ttl" style="margin-bottom: 25px;">Ready To Experience The Best Tracking?</h2>
            <p class="dsc" style="margin-bottom: 45px;">Contact us today for a free demonstration and customized fleet solutions.</p>
            <a href="{{ route('contact') }}" class="bo" style="padding: 18px 45px; font-size: 16px;">Get Started Now</a>
        </div>
    </div>
</section>

<style>
    #scrollTopBtn {
        display: none;
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 99;
        border: none;
        outline: none;
        background: var(--or);
        color: white;
        cursor: pointer;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 20px;
        box-shadow: 0 5px 15px rgba(244,124,32,0.4);
        transition: all 0.3s;
    }
    #scrollTopBtn:hover {
        background: var(--or2);
        transform: translateY(-5px);
    }

    /* Video Hero Animations */
    @keyframes bounceDown {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(10px); }
    }
    @keyframes scrollDot {
        0% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(12px); }
    }

    /* Video Hero Responsive */
    @media(max-width:768px) {
        .video-hero .wrap {
            flex-direction: column !important;
            padding-top: 140px !important;
            padding-bottom: 60px !important;
            gap: 30px !important;
            text-align: center;
        }
        .video-hero .wrap > div:first-child {
            flex: 1 !important;
        }
        .video-hero .wrap > div:last-child {
            flex: 1 !important;
            justify-content: center !important;
        }
        .video-hero .lbl { justify-content: center; }
        .video-hero .ttl { font-size: 28px !important; }
        .video-hero .dsc { margin-left: auto; margin-right: auto; }
    }
</style>
@section('scripts')
<script>
    // Simple video play logic if needed, though autoplay is handled by HTML
    document.getElementById('video1').play();
</script>
@endsection
@endsection
