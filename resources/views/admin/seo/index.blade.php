@extends('layouts.admin')

@section('title', 'SEO Settings')
@section('page_title', 'SEO Settings')

@section('styles')
<style>
    .seo-shell{max-width:980px;margin:0 auto;}
    .seo-head{display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:20px;}
    .seo-controls{display:flex;align-items:center;gap:10px;}
    .seo-arrow{width:42px;height:42px;border-radius:50%;border:1px solid #d1d5db;background:#fff;color:var(--nv);cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:15px;transition:.2s;}
    .seo-arrow:hover{border-color:var(--or);color:var(--or);box-shadow:0 6px 18px rgba(244,124,32,.15);}
    .seo-counter{font-size:13px;color:var(--gy);min-width:70px;text-align:center;font-weight:700;}
    .seo-slider{position:relative;min-height:620px;}
    .seo-slide{display:none;}
    .seo-slide.active{display:block;animation:seoFade .2s ease;}
    .seo-card-title{display:flex;justify-content:space-between;align-items:flex-start;gap:16px;margin-bottom:18px;}
    .seo-card-title h3{font-size:20px;color:var(--nv);text-transform:capitalize;}
    .seo-page-badge{background:#fff7ed;color:var(--or);font-size:12px;font-weight:800;padding:7px 12px;border-radius:999px;}
    .seo-dots{display:flex;justify-content:center;gap:8px;margin-top:16px;flex-wrap:wrap;}
    .seo-dot{width:10px;height:10px;border-radius:50%;border:none;background:#d1d5db;cursor:pointer;padding:0;}
    .seo-dot.active{background:var(--or);transform:scale(1.2);}
    @keyframes seoFade{from{opacity:.4;transform:translateX(8px)}to{opacity:1;transform:translateX(0)}}
    @media(max-width:700px){.seo-head{align-items:flex-start;flex-direction:column}.seo-slider{min-height:auto}.seo-controls{width:100%;justify-content:space-between}}
</style>
@endsection

@section('content')
<div class="seo-shell">
    <div class="seo-head">
        <div>
            <h2 style="margin-bottom:8px;">Page SEO Settings</h2>
            <p class="muted">Har page alag slide me hai. Arrows se next/back karein aur jis page ki SEO change karni ho usi slide par save karein.</p>
        </div>
        <div class="seo-controls">
            <button type="button" class="seo-arrow" onclick="moveSeoSlide(-1)" aria-label="Previous SEO page"><i class="fas fa-chevron-left"></i></button>
            <div class="seo-counter"><span id="seoCurrent">1</span> / <span id="seoTotal">{{ count($pages) }}</span></div>
            <button type="button" class="seo-arrow" onclick="moveSeoSlide(1)" aria-label="Next SEO page"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

    <div class="seo-slider" id="seoSlider">
        @foreach($pages as $pageKey => $defaults)
            @php $savedRow = $saved->get($pageKey, []); @endphp
            <div class="seo-slide {{ $loop->first ? 'active' : '' }}" data-page="{{ $pageKey }}">
                <div class="card">
                    <div class="seo-card-title">
                        <div>
                            <span class="seo-page-badge">{{ $loop->iteration }}</span>
                            <h3 style="margin-top:10px;">{{ str_replace('-', ' ', $pageKey) }} Page</h3>
                            <p class="muted">Website route: {{ $pageKey }}</p>
                        </div>
                        <a href="{{ $pageKey === 'home' ? route('home') : url('/' . $pageKey) }}" target="_blank" class="btn btn-secondary"><i class="fas fa-external-link-alt"></i> View Page</a>
                    </div>

                    <form method="POST" action="{{ route('admin.seo.update') }}">
                        @csrf
                        <input type="hidden" name="page_key" value="{{ $pageKey }}">

                        <div class="form-group">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" value="{{ $savedRow['meta_title'] ?? $defaults['meta_title'] ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label>Meta Description</label>
                            <textarea name="meta_description" rows="3">{{ $savedRow['meta_description'] ?? $defaults['meta_description'] ?? '' }}</textarea>
                        </div>
                        <div class="grid-2">
                            <div class="form-group">
                                <label>OG Title</label>
                                <input type="text" name="og_title" value="{{ $savedRow['og_title'] ?? $defaults['og_title'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label>OG Image URL</label>
                                <input type="text" name="og_image" value="{{ $savedRow['og_image'] ?? '' }}" placeholder="/images/og-default.jpg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>OG Description</label>
                            <textarea name="og_description" rows="3">{{ $savedRow['og_description'] ?? $defaults['og_description'] ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Keywords (comma separated)</label>
                            <input type="text" name="keywords" value="{{ $savedRow['keywords'] ?? $defaults['keywords'] ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save {{ ucfirst(str_replace('-', ' ', $pageKey)) }} SEO</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <div class="seo-dots" aria-label="SEO pages">
        @foreach($pages as $pageKey => $defaults)
            <button type="button" class="seo-dot {{ $loop->first ? 'active' : '' }}" onclick="showSeoSlide({{ $loop->index }})" aria-label="Open {{ $pageKey }} SEO"></button>
        @endforeach
    </div>
</div>

<script>
    let seoIndex = 0;
    const seoSlides = Array.from(document.querySelectorAll('.seo-slide'));
    const seoDots = Array.from(document.querySelectorAll('.seo-dot'));
    const seoCurrent = document.getElementById('seoCurrent');

    function showSeoSlide(index) {
        if (!seoSlides.length) return;
        seoIndex = (index + seoSlides.length) % seoSlides.length;
        seoSlides.forEach((slide, i) => slide.classList.toggle('active', i === seoIndex));
        seoDots.forEach((dot, i) => dot.classList.toggle('active', i === seoIndex));
        seoCurrent.textContent = seoIndex + 1;
    }

    function moveSeoSlide(step) {
        showSeoSlide(seoIndex + step);
    }

    document.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowLeft') moveSeoSlide(-1);
        if (event.key === 'ArrowRight') moveSeoSlide(1);
    });
</script>
@endsection
