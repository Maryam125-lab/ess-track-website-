@extends('layouts.admin')
@section('title', 'Sitemap')
@section('page_title', 'Sitemap')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h2>Website Sitemap</h2>
        <p class="muted">All indexed pages — submit to Google Search Console</p>
    </div>
    <a href="{{ $sitemapUrl }}" target="_blank" class="btn btn-primary"><i class="fas fa-external-link-alt"></i> Open Live Sitemap</a>
</div>

<div class="card" style="padding:0;overflow:hidden;">
<table>
<thead><tr><th>Page</th><th>URL</th><th>Priority</th></tr></thead>
<tbody>
@foreach($pages as $page)
<tr>
<td>{{ $page['label'] }}</td>
<td><a href="{{ $page['url'] }}" target="_blank" style="color:var(--or);font-size:13px;">{{ $page['url'] }}</a></td>
<td>{{ $page['priority'] }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endsection
