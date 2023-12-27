<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForceTeamDomain
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

        $host = $request->host();
        $platform = $request->user()->currentTeam->currentPlatform();
        if (mb_strtolower($host) !== mb_strtolower($platform->domain)) {
            return redirect()->to('https://'.mb_strtolower($platform->domain).$request->getRequestUri());
        }

        return $next($request);
    }
}
