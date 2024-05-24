<?php

namespace App\Actions\InternalNotifications;

use App\Enums\NotificationType;
use App\Enums\Platform;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class LogUserPerformedAction
{
    use AsAction;

    public function handle(
        Platform $platform,
        NotificationType $type,
        string $text,
        array $metadata = [],
    ) {
        if (app()->environment('testing')) {
            return;
        }

        $metadata = [
            'platform' => $platform->value,
            'environment' => app()->environment(),
            ...$metadata,
        ];

        Http::retry(3, 5000)
            ->post('https://discord.com/api/webhooks/1235187187075518554/8HzLsLJji90x5aJti_nu-NMKbEYq0s3hsbvrGo1EijHhG3_cfOGhy5gs2GtiO24npKA4', [
                'content' => $type->icon().$text,
                'embeds' => [
                    [
                        'fields' => collect($metadata)->map(function ($value, $key) {
                            return [
                                'name' => $key,
                                'value' => $value,
                            ];
                        })->values()->all(),
                    ],
                ],
            ])
            ->throw();
    }
}
