<?php

namespace App\Actions\Github;

use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterWebhook
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repositoryName): void
    {
        $secret = Str::random(32);
        $client = GetAuthenticatedAccountGithubClient::make()->handle($account);
        $webhook = $client
            ->repositories()
            ->hooks()
            ->create($repositoryName->username, $repositoryName->name, [
                'name' => 'web',
                'config' => [
                    'url' => route('webhook', ['sourceCodeAccount' => $account]),
                    'content_type' => 'json',
                    'secret' => $secret,
                ],
                'events' => ['push'],
                'active' => true,
            ]);

        $account->webhook_id = $webhook['id'];
        $account->webhook_secret = $secret;
        $account->save();
    }
}
