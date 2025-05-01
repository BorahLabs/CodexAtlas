<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToBuyout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ignore search engines
        if (in_array($request->header('User-Agent'), ['Googlebot', 'Bingbot', 'Baiduspider', 'YandexBot', 'Sogou', 'Exabot', 'facebookexternalhit', 'Twitterbot', 'Slackbot', 'Discordbot', 'TelegramBot', 'WhatsApp', 'LinkedInBot', 'Pinterest', 'RedditBot', 'DiggBot', 'StumbleUpon', 'Slack', 'Discord', 'Telegram', 'WhatsApp', 'LinkedIn', 'Pinterest', 'Reddit', 'Digg', 'StumbleUpon'])) {
            return $next($request);
        }

        if ($request->get('purchase') === 'success') {
            cache(['sold_codex' => true]);
            return redirect()->route('buyout-success');
        }

        if ($request->get('skip_buyout') === 'true') {
            session()->put('skip_buyout', true);
            return redirect(session()->get('redirect_to') ?: request()->redirect_to ?: route('homepage'));
        }

        if ($request->is('buyout-success')) {
            return $next($request);
        }

        // if it was purchased
        if (cache()->get('sold_codex')) {
            if ($request->is('buyout')) {
                return redirect()->route('homepage');
            }

            return $next($request);
        }

        if (! $request->is('buyout') && ! $request->is('redirect-to-buyout')) {
            session()->put('redirect_to', $request->url());
            return redirect()->route('buyout', ['redirect_to' => $request->url(),]);
        }

        return $next($request);
    }
}
