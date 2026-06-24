@extends('layouts.admin')
@section('title', 'Change Password')
@section('page_title', 'Change Password')

@section('content')
<div class="card" style="max-width:720px;">
    <h2>Change Password</h2>
    <p class="muted" style="margin-bottom:22px;">Update the Management Portal password for the current account.</p>

    @if($errors->any())
        <div class="alert alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf

        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input id="current_password" type="password" name="current_password" required autocomplete="current-password">
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label for="password">New Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" minlength="10">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" minlength="10">
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Password</button>
    </form>
</div>
@endsection
