@extends('layouts.admin')

@section('title', 'Success Stories')
@section('page_title', 'Success Stories')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h2>Success Stories</h2>
        <p class="muted">Client case studies shown on /success-stories</p>
    </div>
    <a href="{{ route('admin.success-stories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Story</a>
</div>

<div class="card" style="padding:0;overflow:hidden;">
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Client</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stories as $story)
            <tr>
                <td><strong>{{ $story['title'] }}</strong></td>
                <td>{{ $story['client_name'] ?? '—' }}</td>
                <td><span class="badge badge-{{ $story['status'] }}">{{ ucfirst($story['status']) }}</span></td>
                <td style="display:flex;gap:8px;">
                    <a href="{{ route('admin.success-stories.edit', $story['id']) }}" class="btn btn-secondary" style="padding:6px 12px;font-size:12px;">Edit</a>
                    <a href="{{ route('admin.success-stories.delete', $story['id']) }}" class="btn btn-danger" style="padding:6px 12px;font-size:12px;" onclick="return confirm('Delete this story?')">Delete</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center;padding:40px;" class="muted">No success stories yet. Add them when official client content is ready.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
