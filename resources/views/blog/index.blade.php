@extends('layouts.app')

@section('title', $seo['meta_title'] ?? 'Blog — ESS-TRACK')

@section('content')
<section style="padding-top:140px;padding-bottom:80px;background:var(--of);">
    <div class="wrap">
        <div class="lbl" data-aos="fade-up">Insights & Updates</div>
        <h1 class="ttl" data-aos="fade-up" data-aos-delay="100">ESS-Track <span style="color:var(--or)">Blog</span></h1>
        <p class="dsc" data-aos="fade-up" data-aos-delay="200" style="max-width:600px;margin-bottom:50px;">Expert articles on GPS vehicle tracking, fleet management, and security — from Pakistan's best tracking provider.</p>

        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:30px;">
            @foreach($posts as $post)
            <article class="card" data-aos="fade-up" style="background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.06);transition:transform .3s;">
                @if(!empty($post['image_url']))
                <a href="{{ route('blog.show', $post['slug']) }}">
                    <img src="{{ $post['image_url'] }}" alt="{{ $post['title'] }}" style="width:100%;height:200px;object-fit:cover;">
                </a>
                @endif
                <div style="padding:24px;">
                    <div style="font-size:12px;color:var(--gy);margin-bottom:8px;">
                        {{ $post['published_at'] ? date('M d, Y', strtotime($post['published_at'])) : '' }}
                        &middot; {{ $post['author'] ?? 'ESS-Track Team' }}
                    </div>
                    <h2 style="font-size:18px;font-weight:700;margin-bottom:10px;line-height:1.4;">
                        <a href="{{ route('blog.show', $post['slug']) }}" style="color:var(--nv);text-decoration:none;">{{ $post['title'] }}</a>
                    </h2>
                    <p style="font-size:14px;color:var(--gy);line-height:1.7;margin-bottom:16px;">{{ $post['excerpt'] }}</p>
                    <a href="{{ route('blog.show', $post['slug']) }}" style="color:var(--or);font-weight:600;font-size:13px;text-decoration:none;">Read More <i class="fas fa-arrow-right"></i></a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
