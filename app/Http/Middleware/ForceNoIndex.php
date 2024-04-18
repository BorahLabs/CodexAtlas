<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceNoIndex
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if (method_exists($response, 'header')) {
            $response->header('X-Robots-Tag', 'noindex, nofollow, noarchive, nosnippet, noodp, notranslate, noimageindex');
        }

        return $response;
    }
}
