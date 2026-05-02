<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);

        // Logic to send email or save to DB goes here
        
        return back()->with('success', 'Thank you for your message! Our team will contact you soon.');
    }
}
