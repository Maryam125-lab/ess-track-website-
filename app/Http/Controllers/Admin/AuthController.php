<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortalUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:150',
            'password' => 'required|string|min:8|max:200',
        ]);

        $user = PortalUser::where('email', strtolower($request->email))
            ->where('is_active', true)
            ->first();

        if ($user && Hash::check($request->password, $user->password_hash)) {
            $request->session()->regenerate();
            $request->session()->put('admin_authenticated', true);
            $request->session()->put('admin_user_id', $user->id);
            $request->session()->put('admin_email', $user->email);
            $user->forceFill(['last_login_at' => now()])->save();

            return redirect()->route('admin.dashboard')->with('success', 'Successfully logged in.');
        }

        return back()->with('error', 'Invalid email or password.')->withInput();
    }

    public function showPasswordForm()
    {
        return view('admin.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string', 'min:8', 'max:200'],
            'password' => ['required', 'string', 'min:10', 'max:200', 'confirmed'],
        ]);

        $user = PortalUser::whereKey($request->session()->get('admin_user_id'))
            ->where('is_active', true)
            ->first();

        if (! $user) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')->with('error', 'Please sign in again.');
        }

        if (! Hash::check($request->current_password, $user->password_hash)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->forceFill([
            'password_hash' => Hash::make($request->password),
        ])->save();

        return back()->with('success', 'Password updated successfully.');
    }
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}

