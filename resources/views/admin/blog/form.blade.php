@extends('layouts.admin')

@section('title', $post ? 'Edit Post' : 'New Post')
@section('page_title', $post ? 'Edit Blog Post' : 'New Blog Post')

@section('content')
<div class="card">
    <form method="POST" action="{{ $post ? route('admin.blog.update', $post['id']) : route('admin.blog.store') }}" enctype="multipart/form-data">
        @csrf
        @if($post) @method('PUT') @endif

        <div class="form-group">
            <label>Title *</label>
            <input type="text" name="title" value="{{ old('title', $post['title'] ?? '') }}" required>
        </div>

        <div class="form-group">
            <label>Excerpt (short summary)</label>
            <textarea name="excerpt" rows="2">{{ old('excerpt', $post['excerpt'] ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label>Content (HTML allowed) *</label>
            <textarea name="content" rows="12" required>{{ old('content', $post['content'] ?? '') }}</textarea>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label>Featured Image URL</label>
                <input type="text" name="image_url" value="{{ old('image_url', $post['image_url'] ?? '') }}" placeholder="https://... or images/uploads/photo.jpg">
                <input type="file" name="image_file" accept="image/*" style="margin-top:8px;">
                @if(!empty($post['image_url']))<p class="muted" style="margin-top:6px;">Current: {{ $post['image_url'] }}</p>@endif
            </div>
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" value="{{ old('author', $post['author'] ?? 'ESS-Track Team') }}">
            </div>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label>Status *</label>
                <select name="status">
                    <option value="draft" {{ old('status', $post['status'] ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status', $post['status'] ?? '') === 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
            <div class="form-group">
                <label>Publish Date</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', isset($post['published_at']) ? date('Y-m-d\TH:i', strtotime($post['published_at'])) : '') }}">
            </div>
        </div>

        <hr style="margin:24px 0;border:none;border-top:1px solid #e5e7eb;">
        <h3 style="font-size:16px;margin-bottom:16px;">SEO (optional)</h3>

        <div class="form-group">
            <label>Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $post['meta_title'] ?? '') }}">
        </div>
        <div class="form-group">
            <label>Meta Description</label>
            <textarea name="meta_description" rows="2">{{ old('meta_description', $post['meta_description'] ?? '') }}</textarea>
        </div>

        @if($post)
        <div class="form-group">
            <label><input type="checkbox" name="regenerate_slug" value="1"> Regenerate URL slug from title</label>
        </div>
        @endif

        <div style="display:flex;gap:12px;margin-top:20px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Post</button>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
