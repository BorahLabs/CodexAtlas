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
        if ($host !== $platform->domain) {
            return redirect()->to('https://' . $platform->domain . $request->getRequestUri());
        }

        return $next($request);
    }
}
