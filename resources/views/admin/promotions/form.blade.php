@extends('layouts.admin')
@section('title', $promotion ? 'Edit Promotion' : 'New Promotion')
@section('page_title', $promotion ? 'Edit Promotion' : 'New Promotion')
@section('content')
<div class="card">
<form method="POST" action="{{ $promotion ? route('admin.promotions.update', $promotion['id']) : route('admin.promotions.store') }}">@csrf @if($promotion) @method('PUT') @endif
<div class="form-group"><label>Title *</label><input name="title" value="{{ old('title', $promotion['title'] ?? '') }}" required></div>
<div class="form-group"><label>Description</label><textarea name="description" rows="2">{{ old('description', $promotion['description'] ?? '') }}</textarea></div>
<div class="grid-2">
<div class="form-group"><label>Promo / Referral Code</label><input name="promo_code" value="{{ old('promo_code', $promotion['promo_code'] ?? '') }}" placeholder="ESSREF2026"></div>
        <div class="form-group"><label>Discount Badge (shown on website) *</label><input name="badge_text" value="{{ old('badge_text', $promotion['badge_text'] ?? '') }}" placeholder="10% OFF" required></div>
        </div>
        <div class="grid-2">
        <div class="form-group"><label>Discount Type</label><select name="discount_type"><option value="percent" {{ old('discount_type', $promotion['discount_type'] ?? '')==='percent'?'selected':'' }}>Percent %</option><option value="fixed" {{ old('discount_type', $promotion['discount_type'] ?? '')==='fixed'?'selected':'' }}>Fixed PKR</option><option value="offer_text" {{ old('discount_type', $promotion['discount_type'] ?? '')==='offer_text'?'selected':'' }}>Text Offer</option></select></div>
        <div class="form-group"><label>Discount Value</label><input name="discount_value" value="{{ old('discount_value', $promotion['discount_value'] ?? '') }}" placeholder="10"></div>
</div>
<div class="form-group"><label>Applies To</label><select name="applies_to"><option value="all">All Packages</option><option value="basic" {{ old('applies_to', $promotion['applies_to'] ?? '')==='basic'?'selected':'' }}>Basic</option><option value="silver" {{ old('applies_to', $promotion['applies_to'] ?? '')==='silver'?'selected':'' }}>Silver</option><option value="gold" {{ old('applies_to', $promotion['applies_to'] ?? '')==='gold'?'selected':'' }}>Gold</option><option value="tracker" {{ old('applies_to', $promotion['applies_to'] ?? '')==='tracker'?'selected':'' }}>Tracker Device</option></select></div>
<div class="grid-2">
<div class="form-group"><label>Valid From</label><input type="date" name="valid_from" value="{{ old('valid_from', $promotion['valid_from'] ?? '') }}"></div>
<div class="form-group"><label>Valid Until</label><input type="date" name="valid_until" value="{{ old('valid_until', $promotion['valid_until'] ?? '') }}"></div>
</div>
<div class="form-group"><label>Status</label><select name="status"><option value="active">Active</option><option value="inactive" {{ old('status', $promotion['status'] ?? '')==='inactive'?'selected':'' }}>Inactive</option></select></div>
<div class="form-group"><label>Show on website:</label><label><input type="checkbox" name="show_on_home" value="1" {{ old('show_on_home', $promotion['show_on_home'] ?? true)?'checked':'' }}> Home page bar</label><br><label><input type="checkbox" name="show_on_services" value="1" {{ old('show_on_services', $promotion['show_on_services'] ?? true)?'checked':'' }}> Packages page</label><br><label><input type="checkbox" name="show_on_promo_modal" value="1" {{ old('show_on_promo_modal', $promotion['show_on_promo_modal'] ?? true)?'checked':'' }}> Home promo popup</label></div>
<button class="btn btn-primary"><i class="fas fa-save"></i> Save Promotion</button>
</form>
</div>
@endsection
