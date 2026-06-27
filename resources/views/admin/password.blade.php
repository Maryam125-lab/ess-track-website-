@extends('layouts.admin')
@section('title', 'Change Password')
@section('page_title', 'Change Password')

@section('content')
<style>
    .password-field{position:relative;}
    .password-field input{padding-right:78px;}
    .password-toggle{position:absolute;right:8px;top:50%;transform:translateY(-50%);border:none;background:#eef1f5;color:#374151;border-radius:7px;padding:7px 10px;font-size:12px;font-weight:700;cursor:pointer;}
    .password-toggle:hover{background:#e5e7eb;}
</style>

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
            <div class="password-field">
                <input id="current_password" type="password" name="current_password" required autocomplete="current-password">
                <button type="button" class="password-toggle" data-toggle-password="current_password">Show</button>
            </div>
        </div>

        <div class="grid-2">
            <div class="form-group">
                <label for="password">New Password</label>
                <div class="password-field">
                    <input id="password" type="password" name="password" required autocomplete="new-password" minlength="10">
                    <button type="button" class="password-toggle" data-toggle-password="password">Show</button>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <div class="password-field">
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" minlength="10">
                    <button type="button" class="password-toggle" data-toggle-password="password_confirmation">Show</button>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Password</button>
    </form>
</div>

<script>
    document.querySelectorAll('[data-toggle-password]').forEach(function (button) {
        button.addEventListener('click', function () {
            var input = document.getElementById(button.dataset.togglePassword);
            if (!input) return;
            var showing = input.type === 'text';
            input.type = showing ? 'password' : 'text';
            button.textContent = showing ? 'Show' : 'Hide';
        });
    });
</script>
@endsection
