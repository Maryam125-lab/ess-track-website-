<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\ServiceOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PublicApiController extends Controller
{
    public function sendOtp(Request $request): JsonResponse
    {
        $request->validate([
            'phone' => ['required', 'string', 'min:10', 'max:20'],
            'method' => ['nullable', 'string', 'max:20'],
        ]);

        Cache::put($this->otpCodeKey($request->phone), '1234', now()->addMinutes(10));

        return response()->json([
            'status' => 'success',
            'success' => true,
            'message' => 'OTP sent successfully.',
        ]);
    }

    public function verifyOtp(Request $request): JsonResponse
    {
        $request->validate([
            'phone' => ['required', 'string', 'min:10', 'max:20'],
            'otp' => ['required', 'string', 'size:4'],
        ]);

        $valid = Cache::get($this->otpCodeKey($request->phone)) === $request->otp;

        if (! $valid) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'message' => 'Invalid OTP.',
            ], 422);
        }

        Cache::put($this->otpVerifiedKey($request->phone), true, now()->addMinutes(30));

        return response()->json([
            'status' => 'success',
            'success' => true,
            'message' => 'Phone number verified.',
        ]);
    }

    public function storeInquiry(Request $request): JsonResponse
    {
        if ($this->isServiceOrder($request)) {
            return $this->storeServiceOrder($request);
        }

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['required_without:phone_number', 'nullable', 'string', 'max:30'],
            'phone_number' => ['required_without:phone', 'nullable', 'string', 'max:30'],
            'vehicle_type' => ['nullable', 'string', 'max:100'],
            'package' => ['nullable', 'string', 'max:100'],
            'interested_package' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string'],
        ]);

        $payload = [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'] ?? '',
            'email' => $data['email'] ?? '',
            'phone_number' => $data['phone_number'] ?? $data['phone'] ?? '',
            'vehicle_type' => $data['vehicle_type'] ?? '',
            'interested_package' => $data['interested_package'] ?? $data['package'] ?? 'Not Sure',
            'message' => $data['message'],
        ];

        if (! $this->phoneVerified($payload['phone_number'])) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'message' => 'Please verify your phone number first.',
            ], 422);
        }

        if ($this->databaseReady('inquiries')) {
            $row = Inquiry::create($payload);

            return response()->json([
                'status' => 'success',
                'success' => true,
                'id' => $row->id,
                'message' => 'Inquiry saved successfully.',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'success' => false,
            'message' => 'Database is not connected yet.',
        ], 503);
    }

    private function storeServiceOrder(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'mobile' => ['required', 'string', 'max:30'],
            'vehicle_no' => ['nullable', 'string', 'max:50'],
            'v_type' => ['nullable', 'string', 'max:50'],
            'pkg_description' => ['nullable', 'string', 'max:100'],
            'pkg_rate' => ['nullable', 'string', 'max:50'],
            'pkg_price' => ['nullable', 'string', 'max:50'],
            'res_address' => ['nullable', 'string'],
            'comm_address' => ['nullable', 'string'],
            'postal_code' => ['nullable', 'string', 'max:20'],
            'num_home' => ['nullable', 'string', 'max:30'],
            'num_office' => ['nullable', 'string', 'max:30'],
            'message' => ['nullable', 'string'],
        ]);

        if (! $this->phoneVerified($data['mobile'])) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'message' => 'Please verify your phone number first.',
            ], 422);
        }

        if (! $this->databaseReady('service_orders')) {
            return response()->json([
                'status' => 'error',
                'success' => false,
                'message' => 'Database is not connected yet.',
            ], 503);
        }

        $row = ServiceOrder::create([
            'customer_name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['mobile'],
            'vehicle_no' => $data['vehicle_no'] ?? '',
            'vehicle_type' => $data['v_type'] ?? '',
            'interested_package' => $data['pkg_description'] ?? 'Not Sure',
            'package_rate' => $data['pkg_rate'] ?? '',
            'package_price' => $data['pkg_price'] ?? '',
            'residential_address' => $data['res_address'] ?? '',
            'commercial_address' => $data['comm_address'] ?? '',
            'postal_code' => $data['postal_code'] ?? '',
            'home_phone' => $data['num_home'] ?? '',
            'office_phone' => $data['num_office'] ?? '',
            'message' => $data['message'] ?? '',
            'raw_payload' => $request->except(['_token']),
            'status' => 'new',
        ]);

        return response()->json([
            'status' => 'success',
            'success' => true,
            'id' => $row->id,
            'message' => 'Service order saved successfully.',
        ]);
    }

    private function isServiceOrder(Request $request): bool
    {
        return $request->has('vehicle_no') || $request->has('pkg_description') || $request->has('mobile');
    }

    private function databaseReady(string $table): bool
    {
        try {
            DB::connection()->getPdo();

            return Schema::hasTable($table);
        } catch (\Throwable $e) {
            return false;
        }
    }

    private function phoneVerified(string $phone): bool
    {
        return Cache::get($this->otpVerifiedKey($phone)) === true;
    }

    private function otpCodeKey(string $phone): string
    {
        return 'public_otp_code:' . hash('sha256', $phone);
    }

    private function otpVerifiedKey(string $phone): string
    {
        return 'public_otp_verified:' . hash('sha256', $phone);
    }
}
