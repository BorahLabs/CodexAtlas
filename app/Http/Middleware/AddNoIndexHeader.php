<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddNoIndexHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config('app.indexable')) {
            return $next($request);
        }

        return $next($request)
            ->header('X-Robots-Tag', 'noindex, nofollow, noarchive, nosnippet, noodp, notranslate, noimageindex');
    }
}
