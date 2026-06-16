<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StrictCors
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->is('api/*')) {
            return $next($request);
        }

        $origin = $request->headers->get('Origin');

        if (! $origin) {
            return $next($request);
        }

        if (! in_array($origin, config('cors.allowed_origins', []), true)) {
            if ($request->isMethod('OPTIONS')) {
                return response('', 403);
            }

            return $next($request);
        }

        if ($request->isMethod('OPTIONS')) {
            return $this->withCorsHeaders(response('', 204), $origin);
        }

        return $this->withCorsHeaders($next($request), $origin);
    }

    private function withCorsHeaders(Response $response, string $origin): Response
    {
        $response->headers->set('Access-Control-Allow-Origin', $origin);
        $response->headers->set('Vary', 'Origin');
        $response->headers->set('Access-Control-Allow-Methods', implode(', ', config('cors.allowed_methods', [])));
        $response->headers->set('Access-Control-Allow-Headers', implode(', ', config('cors.allowed_headers', [])));
        $response->headers->set('Access-Control-Max-Age', (string) config('cors.max_age', 86400));

        return $response;
    }
}
