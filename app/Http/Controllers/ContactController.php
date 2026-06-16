<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:30',
            'vehicle_type' => 'nullable|string|max:100',
            'package' => 'nullable|string|max:100',
            'interested_package' => 'nullable|string|max:100',
            'message' => 'required|string|max:3000',
        ]);

        $name = trim($data['name'] ?? trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? '')));
        [$firstName, $lastName] = array_pad(explode(' ', $name, 2), 2, '');

        try {
            if (Schema::hasTable('inquiries')) {
                Inquiry::create([
                    'first_name' => $data['first_name'] ?? $firstName,
                    'last_name' => $data['last_name'] ?? $lastName,
                    'email' => $data['email'] ?? '',
                    'phone_number' => $data['phone'],
                    'vehicle_type' => $data['vehicle_type'] ?? '',
                    'interested_package' => $data['interested_package'] ?? $data['package'] ?? 'Not Sure',
                    'message' => $data['message'],
                ]);
            }
        } catch (\Throwable $e) {
            report($e);
        }
        
        return back()->with('success', 'Thank you for your message! Our team will contact you soon.');
    }
}
