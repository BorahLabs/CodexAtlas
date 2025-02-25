<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

class DynamicHoneypot
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->isMethod('POST')) {
            Route::getCurrentRoute()->withoutMiddleware(ProtectAgainstSpam::class);
            return $next($request);
        }

        if (!$request->is('register')) {
            Route::getCurrentRoute()->withoutMiddleware(ProtectAgainstSpam::class);
            return $next($request);
        }

        return $next($request);
    }
}
