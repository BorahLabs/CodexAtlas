<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;
use Illuminate\Support\Facades\Http;

class Turnstile extends Field
{
    protected string $view = 'forms.components.turnstile';

    public static function verify(string $token): bool
    {
        $data = [
            'secret' => config('services.cloudflare.turnstile.secret_key'),
            'response' => $token,
        ];
        return Http::asForm()
            ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', $data)
            ->json('success', false);
    }
}
