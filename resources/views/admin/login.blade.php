<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Login - ESS-Track CMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root{--nv:#0d1b2a;--or:#f47c20;--gy:#6b7280;--err:#dc2626;--ok:#059669;}
        *{margin:0;padding:0;box-sizing:border-box;}
        body{font-family:'Segoe UI',system-ui,-apple-system,sans-serif;background:#f7f8fa;color:#111827;min-height:100vh;display:grid;place-items:center;padding:24px;}
        .login-card{width:100%;max-width:420px;background:#fff;border-radius:12px;padding:24px;box-shadow:0 1px 8px rgba(0,0,0,.08);}
        .login-head{text-align:center;margin-bottom:24px;}
        .lock{width:56px;height:56px;background:linear-gradient(135deg,#f47c20,#d96a10);border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;color:#fff;font-size:22px;}
        h1{font-size:24px;margin-bottom:8px;}
        .muted{font-size:13px;color:var(--gy);}
        .alert{padding:12px 14px;border-radius:8px;margin-bottom:18px;font-size:14px;}
        .alert-success{background:#d1fae5;color:#065f46;}
        .alert-error{background:#fee2e2;color:#991b1b;}
        .form-group{margin-bottom:18px;}
        label{display:block;font-size:13px;font-weight:600;margin-bottom:6px;color:#374151;}
        input{width:100%;padding:11px 14px;border:1px solid #d1d5db;border-radius:8px;font:inherit;font-size:14px;}
        input:focus{outline:none;border-color:var(--or);box-shadow:0 0 0 3px rgba(244,124,32,.12);}
        .password-row{position:relative;}
        .show-btn{position:absolute;right:8px;top:50%;transform:translateY(-50%);border:none;background:#eef1f5;color:#374151;border-radius:7px;padding:7px 10px;font-size:12px;font-weight:700;cursor:pointer;}
        .login-btn{width:100%;display:flex;align-items:center;justify-content:center;gap:8px;border:none;background:var(--or);color:#fff;border-radius:8px;padding:14px;font:inherit;font-size:14px;font-weight:700;cursor:pointer;}
        .login-btn:hover{background:#d96a10;}
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-head">
            <div class="lock"><i class="fas fa-lock"></i></div>
            <h1>ESS-Track CMS</h1>
            <p class="muted">Sign in to manage website content</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@esspl.com.pk">
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="password-row">
                    <input type="password" id="adminPassword" name="password" required placeholder="Enter password" style="padding-right:76px;">
                    <button type="button" class="show-btn" id="togglePassword">Show</button>
                </div>
            </div>
            <button type="submit" class="login-btn"><i class="fas fa-sign-in-alt"></i> Login to Admin</button>
        </form>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const input = document.getElementById('adminPassword');
            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            this.textContent = isHidden ? 'Hide' : 'Show';
        });
    </script>
</body>
</html>
