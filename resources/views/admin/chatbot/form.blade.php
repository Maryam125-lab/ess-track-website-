@extends('layouts.admin')
@section('title', 'Chatbot FAQ')
@section('page_title', $faq ? 'Edit FAQ' : 'Add FAQ')
@section('content')
<div class="card">
<form method="POST" action="{{ $faq ? route('admin.chatbot.update', $faq['id']) : route('admin.chatbot.store') }}">@csrf @if($faq) @method('PUT') @endif
<div class="form-group"><label>Question *</label><input name="question" value="{{ old('question', $faq['question'] ?? '') }}" required placeholder="What packages do you offer?"></div>
<div class="form-group"><label>Answer *</label><textarea name="answer" rows="4" required>{{ old('answer', $faq['answer'] ?? '') }}</textarea></div>
<div class="form-group"><label>Keywords (comma separated)</label><input name="keywords" value="{{ old('keywords', $faq['keywords'] ?? '') }}" placeholder="package,price,basic,silver"></div>
<div class="grid-2">
<div class="form-group"><label>Status</label><select name="status"><option value="active">Active</option><option value="inactive" {{ old('status', $faq['status'] ?? '')==='inactive'?'selected':'' }}>Inactive</option></select></div>
<div class="form-group"><label>Sort Order</label><input type="number" name="sort_order" value="{{ old('sort_order', $faq['sort_order'] ?? 0) }}"></div>
</div>
<button class="btn btn-primary"><i class="fas fa-save"></i> Save FAQ</button>
</form>
</div>
@endsection
