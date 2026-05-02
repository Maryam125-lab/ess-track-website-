@extends('layouts.app')

@section('title', 'Vehicle Tracker — ESS-TRACK BY ESSPL')

@section('content')
<!-- INNER HERO -->
<section style="background: var(--nv); padding: 160px 0 100px; color: #fff; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    <div class="wrap" style="position: relative; z-index: 2; text-align: center;">
        <div class="lbl c" style="color: var(--or);">Advanced Monitoring</div>
        <h2 class="ttl" style="color: #fff; margin-bottom: 20px;">Elite Vehicle <span style="color: var(--or);">Tracker</span></h2>
        <p class="dsc" style="color: rgba(255,255,255,0.7); max-width: 700px; margin: 0 auto;">Experience the next generation of GPS tracking with real-time analytics, theft prevention, and fleet optimization tools.</p>
    </div>
</section>

<!-- TRACKER INTERFACE MOCKUP -->
<section style="background: #fff; padding-top: 0; margin-top: -60px;">
    <div class="wrap">
        <div style="background: #fff; border-radius: 30px; box-shadow: 0 40px 100px rgba(0,0,0,0.12); padding: 40px; position: relative; z-index: 5;" data-aos="fade-up">
            <div style="display: flex; gap: 40px; flex-wrap: wrap; align-items: center;">
                <div style="flex: 1; min-width: 300px;">
                    <div class="lbl">Smart Monitoring</div>
                    <h2 class="ttl" style="font-size: 32px;">Real-Time Control Panel</h2>
                    <p class="dsc" style="margin-bottom: 30px;">Our web and mobile interface allows you to stay connected to your vehicle 24/7. Watch movements as they happen, check ignition status, and set custom boundaries.</p>
                    
                    <ul style="list-style: none; padding: 0; margin-bottom: 35px;">
                        <li style="margin-bottom: 18px; display: flex; align-items: center; gap: 15px;">
                            <div style="width: 35px; height: 35px; background: var(--lt); color: var(--or); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;"><i class="fas fa-location-dot"></i></div>
                            <div>
                                <strong style="color: var(--nv); font-size: 15px;">Live GPS Tracking</strong>
                                <p style="font-size: 13px; color: var(--gy);">Pinpoint accuracy within 5 meters.</p>
                            </div>
                        </li>
                        <li style="margin-bottom: 18px; display: flex; align-items: center; gap: 15px;">
                            <div style="width: 35px; height: 35px; background: var(--lt); color: var(--or); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;"><i class="fas fa-shield-halved"></i></div>
                            <div>
                                <strong style="color: var(--nv); font-size: 15px;">Remote Immobilization</strong>
                                <p style="font-size: 13px; color: var(--gy);">Kill the engine remotely in case of theft.</p>
                            </div>
                        </li>
                        <li style="margin-bottom: 18px; display: flex; align-items: center; gap: 15px;">
                            <div style="width: 35px; height: 35px; background: var(--lt); color: var(--or); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;"><i class="fas fa-draw-polygon"></i></div>
                            <div>
                                <strong style="color: var(--nv); font-size: 15px;">Geo-Fence Protection</strong>
                                <p style="font-size: 13px; color: var(--gy);">Define safe zones and get notified on exit.</p>
                            </div>
                        </li>
                    </ul>
                    
                    <a href="{{ route('contact') }}" class="bo">Request Demo</a>
                </div>
                <div style="flex: 1.2; min-width: 300px; text-align: center;">
                    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?q=80&w=1000&auto=format&fit=crop" alt="Tracker UI" style="width: 100%; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.08);">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TECHNICAL SPECS -->
<section style="background: var(--of);">
    <div class="wrap">
        <div class="tc" style="margin-bottom: 60px;" data-aos="fade-up">
            <div class="lbl c">Specifications</div>
            <h2 class="ttl">The Hardware Excellence</h2>
            <p class="dsc">We use the most reliable tracking hardware in Pakistan, tested for extreme conditions.</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
            <div class="hover-lift" style="background: #fff; padding: 35px; border-radius: 20px; text-align: center; border: 1px solid rgba(0,0,0,0.05);" data-aos="fade-up" data-aos-delay="100">
                <div style="font-size: 32px; color: var(--or); margin-bottom: 20px;"><i class="fas fa-microchip"></i></div>
                <h4 style="color: var(--nv); margin-bottom: 10px;">Fast Processor</h4>
                <p style="font-size: 14px; color: var(--gy);">Ultra-fast data processing for real-time updates.</p>
            </div>
            <div class="hover-lift" style="background: #fff; padding: 35px; border-radius: 20px; text-align: center; border: 1px solid rgba(0,0,0,0.05);" data-aos="fade-up" data-aos-delay="200">
                <div style="font-size: 32px; color: var(--or); margin-bottom: 20px;"><i class="fas fa-battery-full"></i></div>
                <h4 style="color: var(--nv); margin-bottom: 10px;">Back-up Battery</h4>
                <p style="font-size: 14px; color: var(--gy);">Stays active even if car battery is disconnected.</p>
            </div>
            <div class="hover-lift" style="background: #fff; padding: 35px; border-radius: 20px; text-align: center; border: 1px solid rgba(0,0,0,0.05);" data-aos="fade-up" data-aos-delay="300">
                <div style="font-size: 32px; color: var(--or); margin-bottom: 20px;"><i class="fas fa-satellite"></i></div>
                <h4 style="color: var(--nv); margin-bottom: 10px;">Dual Antenna</h4>
                <p style="font-size: 14px; color: var(--gy);">Enhanced signal strength in basements & tunnels.</p>
            </div>
            <div class="hover-lift" style="background: #fff; padding: 35px; border-radius: 20px; text-align: center; border: 1px solid rgba(0,0,0,0.05);" data-aos="fade-up" data-aos-delay="400">
                <div style="font-size: 32px; color: var(--or); margin-bottom: 20px;"><i class="fas fa-cloud-upload"></i></div>
                <h4 style="color: var(--nv); margin-bottom: 10px;">Cloud Sync</h4>
                <p style="font-size: 14px; color: var(--gy);">Instant data sync with our secure servers.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ / INFO -->
<section style="background: #fff;">
    <div class="wrap">
        <div style="display: flex; gap: 60px; flex-wrap: wrap; align-items: center;">
            <div style="flex: 1;" data-aos="fade-right">
                <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?q=80&w=1000&auto=format&fit=crop" alt="Car Security" style="width: 100%; border-radius: 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
            </div>
            <div style="flex: 1.2;" data-aos="fade-left">
                <div class="lbl">Installation</div>
                <h2 class="ttl">Professional Setup</h2>
                <p class="dsc" style="margin-bottom: 30px;">Our expert technicians provide seamless and covert installation at your doorstep or our authorized service centers. We ensure no wiring is visible and your warranty remains intact.</p>
                
                <div style="background: var(--lt); padding: 30px; border-radius: 20px; border-left: 5px solid var(--or);">
                    <p style="font-size: 15px; color: var(--nv); font-weight: 600; font-style: italic;">"The installation was quick, clean, and the app started working immediately. Truly professional service."</p>
                    <div style="margin-top: 15px; font-size: 13px; font-weight: 700; color: var(--gy);">— Arsalan Ahmed, Fleet Manager</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TRACKER CTA -->
<section style="background: var(--nv); padding: 100px 0; text-align: center;">
    <div class="wrap">
        <h2 class="ttl" style="color: #fff; margin-bottom: 30px;">Get Your Advanced Tracker Installed Today</h2>
        <a href="{{ route('contact') }}" class="bo" style="padding: 18px 45px;">Book Installation Now</a>
    </div>
</section>
@endsection
