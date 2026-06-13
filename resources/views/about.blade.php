@extends('layouts.app')

@section('title', $seo['meta_title'] ?? 'About Us — ESS-TRACK BY ESSPL')

@section('content')
@php
    $pc = fn($key, $default = '') => $pageContent[$key] ?? $default;
@endphp
<!-- INNER HERO -->
<section style="background: var(--nv); padding: 160px 0 100px; color: #fff; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    <div class="wrap" style="position: relative; z-index: 2; text-align: center;">
        <div class="lbl c" style="color: var(--or);">{{ $pc('hero_label', 'Our Story') }}</div>
        <h2 class="ttl" style="color: #fff; margin-bottom: 20px;">{!! $pc('hero_title_html', 'Dedicated To <span style="color: var(--or);">Your Safety</span>') !!}</h2>
        <p class="dsc" style="color: rgba(255,255,255,0.7); max-width: 700px; margin: 0 auto;">{{ $pc('hero_description', "Since 2009, ESS-TRACK BY ESSPL has been Pakistan's leading provider of vehicle security and fleet management solutions.") }}</p>
    </div>
</section>

<!-- VISION & MISSION -->
<section style="background: #fff;">
    <div class="wrap">
        <div style="display: flex; gap: 60px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px;" data-aos="fade-right">
                <div class="lbl">{{ $pc('story_label', 'Who We Are') }}</div>
                <h2 class="ttl">{{ $pc('story_title', 'Excellence In Surveillance') }}</h2>
                <p class="dsc" style="margin-bottom: 25px;">{{ $pc('story_p1', 'Electronic Safety & Security Pvt. Ltd. (ESSPL) was established with a clear vision: to provide the most reliable and technologically advanced security solutions to the people of Pakistan.') }}</p>
                <p class="dsc" style="margin-bottom: 35px;">{{ $pc('story_p2', 'We specialize in GPS-based tracking systems, utilizing the latest 3G/2G communication platforms. Our systems are designed to provide unmatched precision, whether you are tracking a single car or managing a commercial fleet of hundreds.') }}</p>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div style="padding: 25px; background: var(--of); border-radius: 20px;">
                        <h4 style="color: var(--nv); font-size: 17px; margin-bottom: 10px;">Our Mission</h4>
                        <p style="font-size: 13px; color: var(--gy);">{{ $pc('mission_text', 'To empower vehicle owners with real-time data and security tools that protect their assets.') }}</p>
                    </div>
                    <div style="padding: 25px; background: var(--of); border-radius: 20px;">
                        <h4 style="color: var(--nv); font-size: 17px; margin-bottom: 10px;">Our Vision</h4>
                        <p style="font-size: 13px; color: var(--gy);">{{ $pc('vision_text', 'To be the undisputed leader in GPS tracking by delivering innovation and trust.') }}</p>
                    </div>
                </div>
            </div>
            <div style="flex: 0.8; min-width: 300px;" data-aos="fade-left">
                <img src="{{ $pc('story_image_url', 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?q=80&w=1000&auto=format&fit=crop') }}" alt="Team Work" style="width: 100%; border-radius: 30px; box-shadow: 0 30px 60px rgba(0,0,0,0.1);">
            </div>
        </div>
    </div>
</section>

<!-- WHY CHOOSE US -->
<section style="background: var(--nv); color: #fff; padding: 120px 0;">
    <div class="wrap">
        <div class="tc" style="margin-bottom: 70px;">
            <div class="lbl c" style="color: var(--or);">{{ $pc('advantage_label', 'The ESS Advantage') }}</div>
            <h2 class="ttl" style="color: #fff;">{{ $pc('advantage_title', 'Why Thousands Trust Us') }}</h2>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px;">
            <div style="text-align: center;" data-aos="fade-up" data-aos-delay="100">
                <div style="width: 70px; height: 70px; background: rgba(255,255,255,0.05); color: var(--or); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; margin: 0 auto 25px; border: 1px solid rgba(255,255,255,0.1);"><i class="fas fa-certificate"></i></div>
                <h4 style="font-size: 18px; margin-bottom: 15px;">Licensed & Certified</h4>
                <p style="font-size: 14px; color: rgba(255,255,255,0.6);">Fully authorized by PTA and SECP for vehicle tracking operations across Pakistan.</p>
            </div>
            <div style="text-align: center;" data-aos="fade-up" data-aos-delay="200">
                <div style="width: 70px; height: 70px; background: rgba(255,255,255,0.05); color: var(--or); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; margin: 0 auto 25px; border: 1px solid rgba(255,255,255,0.1);"><i class="fas fa-user-shield"></i></div>
                <h4 style="font-size: 18px; margin-bottom: 15px;">24/7 Security</h4>
                <p style="font-size: 14px; color: rgba(255,255,255,0.6);">Our monitoring center is active round the clock to provide theft support and alerts.</p>
            </div>
            <div style="text-align: center;" data-aos="fade-up" data-aos-delay="300">
                <div style="width: 70px; height: 70px; background: rgba(255,255,255,0.05); color: var(--or); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; margin: 0 auto 25px; border: 1px solid rgba(255,255,255,0.1);"><i class="fas fa-microchip"></i></div>
                <h4 style="font-size: 18px; margin-bottom: 15px;">Advanced Tech</h4>
                <p style="font-size: 14px; color: rgba(255,255,255,0.6);">We use high-grade 3G/2G communication modules for seamless real-time connectivity.</p>
            </div>
        </div>
    </div>
</section>

<!-- TEAM / EXPERTISE -->
<section style="background: #fff; padding: 120px 0;">
    <div class="wrap">
        <div style="display: flex; gap: 60px; align-items: center; flex-wrap: wrap-reverse;">
            <div style="flex: 0.8;" data-aos="fade-right">
                <img src="{{ $pc('expertise_image_url', 'https://images.unsplash.com/photo-1497366216548-37526070297c?q=80&w=1000&auto=format&fit=crop') }}" alt="Our Office" style="width: 100%; border-radius: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
            </div>
            <div style="flex: 1.2;" data-aos="fade-left">
                <div class="lbl">{{ $pc('expertise_label', 'Expertise') }}</div>
                <h2 class="ttl">{{ $pc('expertise_title', 'Our Technical Prowess') }}</h2>
                <p class="dsc" style="margin-bottom: 25px;">{{ $pc('expertise_description', 'Behind the screens at ESS-TRACK BY ESSPL is a team of software engineers, hardware experts, and security specialists working tirelessly to maintain our 99.9% uptime.') }}</p>
                
                <div style="margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; font-size: 14px; font-weight: 700; color: var(--nv); margin-bottom: 8px;">
                        <span>Tracking Accuracy</span>
                        <span>98%</span>
                    </div>
                    <div style="height: 6px; background: var(--lt); border-radius: 10px; overflow: hidden;">
                        <div style="width: 98%; height: 100%; background: var(--or); border-radius: 10px;"></div>
                    </div>
                </div>
                <div style="margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; font-size: 14px; font-weight: 700; color: var(--nv); margin-bottom: 8px;">
                        <span>System Uptime</span>
                        <span>99.9%</span>
                    </div>
                    <div style="height: 6px; background: var(--lt); border-radius: 10px; overflow: hidden;">
                        <div style="width: 99.9%; height: 100%; background: var(--or); border-radius: 10px;"></div>
                    </div>
                </div>
                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 14px; font-weight: 700; color: var(--nv); margin-bottom: 8px;">
                        <span>Customer Satisfaction</span>
                        <span>95%</span>
                    </div>
                    <div style="height: 6px; background: var(--lt); border-radius: 10px; overflow: hidden;">
                        <div style="width: 95%; height: 100%; background: var(--or); border-radius: 10px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT CTA -->
<section style="background: var(--of); padding: 100px 0; text-align: center;">
    <div class="wrap">
        <h2 class="ttl" style="margin-bottom: 30px;">{{ $pc('cta_title', "Partner With Pakistan's Most Trusted Tracker") }}</h2>
        <a href="{{ route('contact') }}" class="bo">{{ $pc('cta_button', 'Get Started Today') }}</a>
    </div>
</section>
@endsection
