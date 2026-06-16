<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $directives = [
            "default-src 'self'",
            "base-uri 'self'",
            "object-src 'none'",
            "frame-ancestors 'self'",
            "form-action 'self' https://wa.me",
            "img-src 'self' data: blob: https://images.unsplash.com https://www.transparenttextures.com https://*.google.com https://*.gstatic.com https://*.googleusercontent.com",
            "font-src 'self' data: https://fonts.gstatic.com https://cdnjs.cloudflare.com",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://unpkg.com",
            "script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://unpkg.com",
            "connect-src 'self' https://generativelanguage.googleapis.com",
            "frame-src 'self' https://www.google.com https://maps.google.com",
            "manifest-src 'self'",
        ];

        if (app()->environment('production')) {
            $directives[] = 'upgrade-insecure-requests';
        }

        $headers = [
            'Content-Security-Policy' => implode('; ', $directives),
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'SAMEORIGIN',
            'Referrer-Policy' => 'strict-origin-when-cross-origin',
            'Permissions-Policy' => 'camera=(), microphone=(), geolocation=(self), payment=()',
            'Cross-Origin-Opener-Policy' => 'same-origin-allow-popups',
            'X-XSS-Protection' => '0',
        ];

        foreach ($headers as $name => $value) {
            $response->headers->set($name, $value);
        }

        return $response;
    }
}
