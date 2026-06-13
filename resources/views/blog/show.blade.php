@extends('layouts.app')

@section('title', $seo['meta_title'] ?? $post['title'])

@section('content')
<article style="padding-top:140px;padding-bottom:80px;">
    <div class="wrap" style="max-width:800px;">
        <a href="{{ route('blog.index') }}" style="color:var(--or);font-size:13px;font-weight:600;text-decoration:none;margin-bottom:20px;display:inline-block;"><i class="fas fa-arrow-left"></i> Back to Blog</a>

        @if(!empty($post['image_url']))
        <img src="{{ $post['image_url'] }}" alt="{{ $post['title'] }}" style="width:100%;max-height:400px;object-fit:cover;border-radius:16px;margin-bottom:30px;" data-aos="fade-up">
        @endif

        <div style="font-size:13px;color:var(--gy);margin-bottom:12px;" data-aos="fade-up">
            {{ $post['published_at'] ? date('F d, Y', strtotime($post['published_at'])) : '' }}
            &middot; {{ $post['author'] ?? 'ESS-Track Team' }}
        </div>

        <h1 class="ttl" data-aos="fade-up" style="margin-bottom:24px;">{{ $post['title'] }}</h1>

        <div style="font-size:16px;line-height:1.9;color:var(--md);" data-aos="fade-up">
            {!! $post['content'] !!}
        </div>

        <div style="margin-top:50px;padding:30px;background:var(--of);border-radius:16px;text-align:center;" data-aos="fade-up">
            <h3 style="font-size:20px;font-weight:700;margin-bottom:10px;">Ready to track your fleet?</h3>
            <p style="color:var(--gy);margin-bottom:20px;font-size:14px;">Get the best GPS vehicle tracking in Pakistan with ESS-Track.</p>
            <a href="{{ route('contact') }}" class="bo" style="display:inline-flex;padding:14px 28px;">Get a Free Quote</a>
        </div>
    </div>
</article>
@endsection
