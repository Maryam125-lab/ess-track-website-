@php
    $seoData = $seo ?? app(\App\Services\SeoService::class)->forPage('home');
@endphp
<meta name="description" content="{{ $seoData['meta_description'] }}">
@if(!empty($seoData['keywords']))
<meta name="keywords" content="{{ $seoData['keywords'] }}">
@endif
<link rel="canonical" href="{{ $seoData['canonical'] }}">

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $seoData['site_name'] }}">
<meta property="og:title" content="{{ $seoData['og_title'] }}">
<meta property="og:description" content="{{ $seoData['og_description'] }}">
<meta property="og:image" content="{{ $seoData['og_image'] }}">
<meta property="og:url" content="{{ $seoData['og_url'] }}">
<meta property="og:locale" content="en_PK">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $seoData['og_title'] }}">
<meta name="twitter:description" content="{{ $seoData['og_description'] }}">
<meta name="twitter:image" content="{{ $seoData['og_image'] }}">
@if(!empty($seoData['twitter_handle']))
<meta name="twitter:site" content="{{ $seoData['twitter_handle'] }}">
@endif

@if(!empty($schemas))
    @foreach($schemas as $schema)
    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
    @endforeach
@endif

@if(!empty($articleSchema))
<script type="application/ld+json">{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}</script>
@endif
