<?php

namespace App\Actions\Twist;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class SendMessageToTwistThread
{
    use AsAction;

    public string $commandSignature = 'twist:send';

    public function handle(string|int|null $threadId, string $message): void
    {
        if (! config('services.twist.email') || ! config('services.twist.password') || ! $threadId) {
            return;
        }

        $token = Cache::remember('twist-token-'.config('services.twist.email'), now()->addDay(), fn () => Http::post('https://api.twist.com/api/v3/users/login', [
            'email' => 'raul@borah.agency',
            'password' => 'Rl-Lz-Gz+1997',
        ])->json('token'));

        abort_if(! $token, 500, 'Could not get token');
        Http::withToken($token)->post('https://api.twist.com/api/v3/comments/add', [
            'thread_id' => $threadId,
            'content' => $message,
        ]);
    }
}
