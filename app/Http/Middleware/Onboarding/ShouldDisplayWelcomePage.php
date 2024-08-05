<?php

namespace App\Http\Middleware\Onboarding;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShouldDisplayWelcomePage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return $next($request);
        }

        if (! $request->user()->currentTeam->has_configured_onboarding && !$request->routeIs('filament.onboarding.pages.welcome')) {
            return redirect()->route('filament.onboarding.pages.welcome');
        }

        return $next($request);
    }
}
