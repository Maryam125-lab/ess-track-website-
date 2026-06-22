@extends('layouts.admin')

@section('title', 'Site Settings')
@section('page_title', 'Site Settings')

@section('content')
<div class="card">
    <h2>General Site Settings</h2>
    <p class="muted" style="margin-bottom:20px;">Company info used across the website and SEO schema.</p>

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="grid-2">
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="company_name" value="{{ old('company_name', $settings['company_name'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Brand Name</label>
                <input type="text" name="brand_name" value="{{ old('brand_name', $settings['brand_name'] ?? '') }}" required>
            </div>
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}" required>
            </div>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" value="{{ old('address', $settings['address'] ?? '') }}" required>
        </div>
        <div class="grid-2">
            <div class="form-group">
                <label>Facebook URL</label>
                <input type="url" name="facebook" value="{{ old('facebook', $settings['facebook'] ?? '') }}">
            </div>
            <div class="form-group">
                <label>WhatsApp URL</label>
                <input type="url" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}">
            </div>
        </div>
        <div class="form-group">
            <label>Default OG Image</label>
            <input type="text" name="default_og_image" value="{{ old('default_og_image', $settings['default_og_image'] ?? '') }}" placeholder="/images/og-default.jpg">
            <input type="file" name="default_og_image_file" accept="image/*" style="margin-top:8px;">
            <p class="muted" style="margin-top:6px;">Upload an image or keep using a URL. Uploaded images are stored persistently.</p>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Settings</button>
    </form>
</div>
@endsection
