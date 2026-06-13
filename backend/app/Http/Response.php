<?php

namespace App\Http;

class Response {
    public static function json($success, $message, $data = [], $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode([
            'success'   => $success,
            'status'    => $success ? 'success' : 'error',
            'message'   => $message,
            'timestamp' => date('Y-m-d H:i:s'),
            'data'      => $data
        ]);
        exit;
    }

    public static function success($message, $data = [], $statusCode = 200) {
        self::json(true, $message, $data, $statusCode);
    }

    public static function error($message, $data = [], $statusCode = 400) {
        self::json(false, $message, $data, $statusCode);
    }
}
