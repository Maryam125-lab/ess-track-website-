<?php

namespace App\Http\Middleware;

use App\Services\AnalyticsService;
use Closure;
use Illuminate\Http\Request;

class TrackPageView
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (
            $request->isMethod('GET') &&
            ! $request->ajax() &&
            $response->isSuccessful()
        ) {
            app(AnalyticsService::class)->track(
                '/' . ltrim($request->path(), '/'),
                null,
                $request->headers->get('referer')
            );
        }

        return $response;
    }
}
