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
        if ($request->host() !== config('app.autodoc_domain')) {
            return $next($request);
        }

        config([
            'app.name' => 'AutomaticDocs',
            'cashier.key' => config('autodoc.stripe.key'),
            'cashier.secret' => config('autodoc.stripe.secret'),
            'cashier.webhook.secret' => config('autodoc.stripe.webhook_secret'),
            'mail.from.address' => config('mail.autodoc.from.address'),
            'mail.from.name' => config('mail.autodoc.from.name'),
        ]);

        return $next($request);
    }
}
