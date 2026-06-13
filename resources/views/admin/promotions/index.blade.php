@extends('layouts.admin')

@section('title', 'Promotions')
@section('page_title', 'Promotions & Offers')

@section('content')
<div style="display:flex;justify-content:space-between;margin-bottom:20px;">
    <div>
        <h2>Promotions & Referral Codes</h2>
        <p class="muted">Add offers here - they appear on website home, packages page & promo popup.</p>
    </div>
    <a href="{{ route('admin.promotions.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Promotion</a>
</div>

<div class="card" style="padding:0;overflow:hidden;">
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Code</th>
                <th>Badge</th>
                <th>Applies To</th>
                <th>Status</th>
                <th>Show On</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($promotions as $p)
                <tr>
                    <td><strong>{{ $p['title'] }}</strong></td>
                    <td><code>{{ $p['promo_code'] ?: '-' }}</code></td>
                    <td>{{ $p['badge_text'] ?: '-' }}</td>
                    <td>{{ ucfirst($p['applies_to'] ?? 'all') }}</td>
                    <td><span class="badge badge-{{ $p['status'] }}">{{ ucfirst($p['status']) }}</span></td>
                    <td class="muted" style="font-size:12px;">
                        @if($p['show_on_home'] ?? false) Home @endif
                        @if($p['show_on_services'] ?? false) Services @endif
                        @if($p['show_on_promo_modal'] ?? false) Popup @endif
                    </td>
                    <td style="display:flex;gap:6px;">
                        <a href="{{ route('admin.promotions.edit', $p['id']) }}" class="btn btn-secondary" style="padding:6px 10px;font-size:12px;">Edit</a>
                        <form method="POST" action="{{ route('admin.promotions.destroy', $p['id']) }}" onsubmit="return confirm('Delete this promotion?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" style="padding:6px 10px;font-size:12px;">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:40px;" class="muted">
                        No promotions yet. Add one only when you want an offer to appear on the website.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
