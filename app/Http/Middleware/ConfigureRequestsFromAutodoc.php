<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConfigureRequestsFromAutodoc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        config([
            'app.name' => 'AutomaticDocs',
            'cashier.key' => config('autodoc.stripe.key'),
            'cashier.secret' => config('autodoc.stripe.secret'),
            'cashier.webhook.secret' => config('autodoc.stripe.webhook_secret'),
        ]);

        return $next($request);
    }
}
