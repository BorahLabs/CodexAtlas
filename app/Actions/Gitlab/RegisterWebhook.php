<?php

namespace App\Actions\Gitlab;

use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
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
        $client = GetAuthenticatedAccountGitlabClient::make()->handle($account);
        $projectId = GetProjectIdForRepository::make()->handle($account, $repositoryName);
        $webhook = $client
            ->projects()
            ->addHook($projectId, route('webhook', ['sourceCodeAccount' => $account]), [
                'push_events' => true,
                'token' => $secret,
            ]);

        $account->webhook_id = $webhook['id'];
        $account->webhook_secret = $secret;
        $account->save();
    }
}
