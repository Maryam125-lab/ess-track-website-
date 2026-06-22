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
            $path = '/' . ltrim($request->path(), '/');
            $referrer = $request->headers->get('referer');

            app()->terminating(function () use ($path, $referrer) {
                try {
                    app(AnalyticsService::class)->track($path, null, $referrer);
                } catch (\Throwable $e) {
                    report($e);
                }
            });
        }

        return $response;
    }
}
