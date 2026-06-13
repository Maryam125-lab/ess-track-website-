@extends('layouts.admin')

@section('title', $story ? 'Edit Story' : 'New Story')
@section('page_title', $story ? 'Edit Success Story' : 'New Success Story')

@section('content')
<div class="card">
    <form method="POST" action="{{ $story ? route('admin.success-stories.update', $story['id']) : route('admin.success-stories.store') }}" enctype="multipart/form-data">
        @csrf
        @if($story) @method('PUT') @endif

        <div class="form-group">
            <label>Title *</label>
            <input type="text" name="title" value="{{ old('title', $story['title'] ?? '') }}" required>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label>Client Name</label>
                <input type="text" name="client_name" value="{{ old('client_name', $story['client_name'] ?? '') }}" placeholder="Company name (when available)">
            </div>
            <div class="form-group">
                <label>Industry</label>
                <input type="text" name="industry" value="{{ old('industry', $story['industry'] ?? '') }}" placeholder="e.g. Logistics, Transport">
            </div>
        </div>

        <div class="form-group">
            <label>Excerpt</label>
            <textarea name="excerpt" rows="2">{{ old('excerpt', $story['excerpt'] ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label>Full Story (HTML allowed)</label>
            <textarea name="content" rows="10">{{ old('content', $story['content'] ?? '') }}</textarea>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label>Image URL</label>
                <input type="text" name="image_url" value="{{ old('image_url', $story['image_url'] ?? '') }}" placeholder="https://... or images/uploads/photo.jpg">
                <input type="file" name="image_file" accept="image/*" style="margin-top:8px;">
                @if(!empty($story['image_url']))<p class="muted" style="margin-top:6px;">Current: {{ $story['image_url'] }}</p>@endif
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $story['sort_order'] ?? 0) }}" min="0">
            </div>
        </div>

        <div class="form-group">
            <label>Status *</label>
            <select name="status">
                <option value="published" {{ old('status', $story['status'] ?? 'published') === 'published' ? 'selected' : '' }}>Published - show on website</option>
                <option value="draft" {{ old('status', $story['status'] ?? '') === 'draft' ? 'selected' : '' }}>Draft - hide from website</option>
            </select>
            <p class="muted" style="margin-top:6px;">Draft story website par show nahi hoti. Website par dikhani ho to Published select karein.</p>
        </div>

        <hr style="margin:24px 0;border:none;border-top:1px solid #e5e7eb;">
        <h3 style="font-size:16px;margin-bottom:16px;">SEO (optional)</h3>
        <div class="form-group">
            <label>Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $story['meta_title'] ?? '') }}">
        </div>
        <div class="form-group">
            <label>Meta Description</label>
            <textarea name="meta_description" rows="2">{{ old('meta_description', $story['meta_description'] ?? '') }}</textarea>
        </div>

        @if($story)
        <div class="form-group">
            <label><input type="checkbox" name="regenerate_slug" value="1"> Regenerate URL slug from title</label>
        </div>
        @endif

        <div style="display:flex;gap:12px;margin-top:20px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Story</button>
            <a href="{{ route('admin.success-stories.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
