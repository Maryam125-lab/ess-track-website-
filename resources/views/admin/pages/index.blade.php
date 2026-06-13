@extends('layouts.admin')

@section('title', 'Page Content')
@section('page_title', 'Page Content')

@section('content')
<div class="card">
    <h2>Website Page Content</h2>
    <p class="muted" style="margin-bottom:20px;">Yahan se page ke text, images, videos aur packages change karein. Save ke baad website page reload kar ke result check karein.</p>

    <table>
        <thead>
            <tr>
                <th>Page</th>
                <th>Website URL</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $key => $label)
                <tr>
                    <td><strong>{{ $label }}</strong></td>
                    <td>@if($key === 'global') Shared on all public pages @else <a href="{{ route($key) }}" target="_blank">{{ route($key) }}</a> @endif</td>
                    <td><a class="btn btn-primary" href="{{ route('admin.pages.edit', $key) }}"><i class="fas fa-edit"></i> Edit Content</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
