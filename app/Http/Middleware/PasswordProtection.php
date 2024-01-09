<?php

namespace App\Http\Middleware;

use Closure;

class PasswordProtection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next): mixed
    {
        if (! config('app.password_protected.enabled')) {
            return $next($request);
        }

        if ($request->routeIs('password-protected') && $request->method() === 'GET') {
            return $next($request);
        }

        if ($request->session()->get('password_protection_authenticated')) {
            return $next($request);
        }

        $secret = $request->input('secret');
        if ($secret && $secret === config('app.password_protected.password')) {
            $request->session()->put('password_protection_authenticated', true);
            return $request->routeIs('password-protected') ? redirect()->route('homepage') : $next($request);
        } else if ($secret && $secret !== config('app.password_protected.password')) {
            return redirect()
                ->route('password-protected')
                ->with('error', 'Invalid password');
        }

        return redirect()->route('password-protected');
    }
}
