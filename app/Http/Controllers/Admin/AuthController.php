<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:150',
            'password' => 'required|string',
        ]);

        $email = config('cms.admin_email');
        $password = config('cms.admin_password');

        if ($request->email === $email && $request->password === $password) {
            $request->session()->put('admin_authenticated', true);
            $request->session()->put('admin_email', $request->email);

            return redirect()->route('admin.dashboard')->with('success', 'Successfully logged in.');
        }

        return back()->with('error', 'Invalid email or password.')->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_authenticated', 'admin_email']);

        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
