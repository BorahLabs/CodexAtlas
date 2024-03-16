<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NgrokHelper
{
    // @codeCoverageIgnoreStart

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(config('services.ngrok.active_helper')) {
            $user = User::query()->findOrFail(config('services.ngrok.user_id'));
            Auth::guard('web')->loginUsingId($user->id);
        }
        return $next($request);
    }
    // @codeCoverageIgnoreEnd

}
