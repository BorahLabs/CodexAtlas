<?php

namespace App\Actions\Github;

use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\Cache;
use Lorisleiva\Actions\Concerns\AsAction;

class GetInstallationToken
{
    use AsAction;

    public function handle(string $installationId): array
    {
        return Cache::remember('github-installation-token', now()->addMinutes(50), function () use ($installationId) {
            $response = GitHub::apps()->createInstallationToken($installationId);

            return [
                $response['token'],
                $response['expires_at'],
            ];
        });
    }
}
