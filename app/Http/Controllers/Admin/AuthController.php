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

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
