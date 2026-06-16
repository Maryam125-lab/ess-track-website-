<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/send-otp', [PublicApiController::class, 'sendOtp'])->middleware('throttle:otp')->name('api.send-otp');
Route::post('/verify-otp', [PublicApiController::class, 'verifyOtp'])->middleware('throttle:otp')->name('api.verify-otp');
Route::post('/inquiries', [PublicApiController::class, 'storeInquiry'])->middleware('throttle:inquiries')->name('api.inquiries.store');
