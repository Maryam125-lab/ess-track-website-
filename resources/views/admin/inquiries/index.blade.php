@extends('layouts.admin')

@section('title', 'Inquiries')
@section('page_title', 'Contact Inquiries')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
    <div>
        <h2>Contact Form Inquiries</h2>
        <p class="muted">Leads from the Contact Us page — callback requests & package interest</p>
    </div>
    <span class="badge badge-published">{{ $inquiries->total() }} Total</span>
</div>

<div class="card" style="padding:0;overflow:hidden;">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Car Type</th>
                <th>Interested Package</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inquiries as $inquiry)
            <tr>
                <td>{{ date('M d, Y h:i A', strtotime($inquiry['created_at'])) }}</td>
                <td><strong>{{ $inquiry['customer_name'] ?: '—' }}</strong></td>
                <td><a href="tel:{{ $inquiry['phone'] }}" style="color:var(--or);text-decoration:none;font-weight:600;">{{ $inquiry['phone'] ?: '—' }}</a></td>
                <td><span class="muted">{{ $inquiry['email'] ?: '—' }}</span></td>
                <td>{{ $inquiry['vehicle_type'] ?: '—' }}</td>
                <td><span class="badge badge-published">{{ $inquiry['package'] ?: 'Not Sure' }}</span></td>
                <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inquiry['message'] ?: '—' }}</td>
                <td>
                    <a href="{{ route('admin.inquiries.show', $inquiry['id']) }}" class="btn btn-secondary" style="padding:6px 12px;font-size:12px;">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center;padding:50px;" class="muted">
                    No inquiries yet. When someone submits the contact form, it will appear here.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:18px;">{{ $inquiries->links() }}</div>
@endsection
