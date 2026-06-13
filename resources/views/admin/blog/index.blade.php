@extends('layouts.admin')

@section('title', 'Blog Posts')
@section('page_title', 'Blog Posts')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h2>Blog Posts</h2>
        <p class="muted">Manage blog articles shown on /blog</p>
    </div>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Post</a>
</div>

<div class="card" style="padding:0;overflow:hidden;">
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>
                    <strong>{{ $post['title'] }}</strong><br>
                    <span class="muted">/blog/{{ $post['slug'] }}</span>
                </td>
                <td><span class="badge badge-{{ $post['status'] }}">{{ ucfirst($post['status']) }}</span></td>
                <td>{{ $post['published_at'] ? date('M d, Y', strtotime($post['published_at'])) : '—' }}</td>
                <td style="display:flex;gap:8px;">
                    <a href="{{ route('admin.blog.edit', $post['id']) }}" class="btn btn-secondary" style="padding:6px 12px;font-size:12px;">Edit</a>
                    <form action="{{ route('admin.blog.destroy', $post['id']) }}" method="POST" onsubmit="return confirm('Delete this post?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding:6px 12px;font-size:12px;">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;padding:40px;" class="muted">No blog posts yet. Create your first post.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
