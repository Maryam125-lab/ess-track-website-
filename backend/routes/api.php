<?php

use App\Http\Controllers\InquiryController;
use App\Http\Response;

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestPath = $_SERVER['REQUEST_URI'];

// Basic routing for PHP built-in server
if ($requestMethod === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    exit;
}

header('Access-Control-Allow-Origin: *');

if ($requestMethod === 'POST' && (strpos($requestPath, 'inquiries') !== false)) {
    $controller = new InquiryController($db);
    $controller->submit();
} elseif ($requestMethod === 'POST' && (strpos($requestPath, 'send-otp') !== false)) {
    $controller = new InquiryController($db);
    $controller->sendOtp();
} elseif ($requestMethod === 'POST' && (strpos($requestPath, 'verify-otp') !== false)) {
    $controller = new InquiryController($db);
    $controller->verifyOtp();
} elseif ($requestMethod === 'GET' && (strpos($requestPath, 'status') !== false)) {
    Response::success('Backend is running');
} else {
    Response::error('Not Found: ' . $requestPath, 404);
}



