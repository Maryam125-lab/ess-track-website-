@extends('layouts.app')

@section('title', $seo['meta_title'] ?? 'Success Stories — ESS-TRACK')

@section('content')
<section style="padding-top:140px;padding-bottom:80px;background:var(--of);">
    <div class="wrap">
        <div class="lbl" data-aos="fade-up">Client Results</div>
        <h1 class="ttl" data-aos="fade-up" data-aos-delay="100">Success <span style="color:var(--or)">Stories</span></h1>
        <p class="dsc" data-aos="fade-up" data-aos-delay="200" style="max-width:600px;margin-bottom:50px;">See how businesses across Pakistan use ESS-Track GPS tracking to protect fleets and improve efficiency.</p>

        @if(count($stories) > 0)
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:30px;">
            @foreach($stories as $story)
            <div class="card" data-aos="fade-up" style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.06);">
                @if(!empty($story['image_url']))
                <img src="{{ $story['image_url'] }}" alt="{{ $story['title'] }}" style="width:100%;height:220px;object-fit:cover;">
                @endif
                <div style="padding:28px;">
                    @if(!empty($story['industry']))
                    <span style="font-size:11px;font-weight:700;color:var(--or);text-transform:uppercase;letter-spacing:1px;">{{ $story['industry'] }}</span>
                    @endif
                    <h2 style="font-size:20px;font-weight:700;margin:8px 0 12px;color:var(--nv);">{{ $story['title'] }}</h2>
                    @if(!empty($story['client_name']))
                    <p style="font-size:13px;color:var(--gy);margin-bottom:12px;"><i class="fas fa-building" style="color:var(--or);margin-right:6px;"></i>{{ $story['client_name'] }}</p>
                    @endif
                    <p style="font-size:14px;color:var(--gy);line-height:1.7;">{{ $story['excerpt'] }}</p>
                    @if(!empty($story['content']))
                    <div style="margin-top:16px;font-size:14px;line-height:1.8;color:var(--md);">{!! $story['content'] !!}</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div data-aos="fade-up" style="text-align:center;padding:80px 40px;background:#fff;border-radius:20px;box-shadow:0 4px 24px rgba(0,0,0,.05);">
            <div style="width:80px;height:80px;background:linear-gradient(135deg,var(--or),var(--or2));border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;font-size:32px;color:#fff;">
                <i class="fas fa-trophy"></i>
            </div>
            <h2 style="font-size:24px;font-weight:700;margin-bottom:12px;color:var(--nv);">Success Stories Coming Soon</h2>
            <p style="color:var(--gy);max-width:480px;margin:0 auto 30px;font-size:15px;line-height:1.7;">We are preparing real client case studies. Check back soon or contact us to learn how ESS-Track helps fleets across Pakistan.</p>
            <a href="{{ route('contact') }}" class="bo" style="display:inline-flex;padding:14px 28px;">Contact Us</a>
        </div>
        @endif
    </div>
</section>
@endsection
