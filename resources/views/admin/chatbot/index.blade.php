@extends('layouts.admin')
@section('title', 'Chatbot FAQ')
@section('page_title', 'Chatbot FAQ')

@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:20px;">
    <div><h2>Chatbot FAQ</h2><p class="muted">Add questions customers ask — chatbot uses these first</p></div>
    <a href="{{ route('admin.chatbot.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add FAQ</a>
</div>

<div class="card" style="padding:0;overflow:hidden;">
<table>
<thead><tr><th>Question</th><th>Keywords</th><th>Status</th><th>Actions</th></tr></thead>
<tbody>
@forelse($faqs as $faq)
<tr>
<td><strong>{{ $faq['question'] }}</strong><br><span class="muted" style="font-size:12px;">{{ \Illuminate\Support\Str::limit($faq['answer'], 80) }}</span></td>
<td>{{ $faq['keywords'] ?: '—' }}</td>
<td><span class="badge badge-{{ $faq['status'] }}">{{ ucfirst($faq['status']) }}</span></td>
<td style="display:flex;gap:6px;">
<a href="{{ route('admin.chatbot.edit', $faq['id']) }}" class="btn btn-secondary" style="padding:6px 10px;font-size:12px;">Edit</a>
<form method="POST" action="{{ route('admin.chatbot.destroy', $faq['id']) }}" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button class="btn btn-danger" style="padding:6px 10px;font-size:12px;">Del</button></form>
</td>
</tr>
@empty
<tr><td colspan="4" style="text-align:center;padding:40px;" class="muted">No FAQs. Default built-in FAQs still work.</td></tr>
@endforelse
</tbody>
</table>
</div>
@endsection
