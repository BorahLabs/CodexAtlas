<?php

namespace App\Http\Middleware;

use App\Models\Platform;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ControlRequestsFromPlatform
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->host();
        if (app()->environment('local') && config('app.fake_domain')) {
            $host = config('app.fake_domain');
        }

        abort_if($host === config('app.main_domain'), 404, 'Not Found');
        $platform = Platform::where('domain', $host)->firstOrFail();

        if ($platform->is_public) {
            return $next($request);
        }

        if (is_null($request->user())) {
            return redirect()->route('login');
        }

        abort_unless($platform->team->hasUser($request->user()), 403, 'Forbidden');

        if ($request->route('project')) {
            $projectId = is_string($request->route('project')) ? $request->route('project') : $request->route('project')->id;
            abort_unless($platform->team->projects()->where('id', $projectId)->exists(), 404, 'Not found');
        }

        return $next($request);
    }
}
