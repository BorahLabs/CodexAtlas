<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!config('app.basic_auth.enabled')) {
            return $next($request);
        }

        $hasCredentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));
        $isNotAuthenticated = (
            !$hasCredentials ||
            $_SERVER['PHP_AUTH_USER'] != config('app.basic_auth.username') ||
            $_SERVER['PHP_AUTH_PW']   != config('app.basic_auth.password')
        );

        if ($isNotAuthenticated) {
            return response('Unauthorized.', 401)
                ->header('WWW-Authenticate', 'Basic realm="Access denied"')
                ->header('Cache-Control', 'no-cache, must-revalidate, max-age=0');
        }

        return $next($request)
            ->header('Cache-Control', 'no-cache, must-revalidate, max-age=0');
    }
}
