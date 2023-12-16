<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Models\SourceCodeAccount;
use App\Services\GetUuidFromJson;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterWebhook
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repositoryName, array $events = ['repo:push'])
    {
        $secret = Str::random(32);
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);
        $webhook = $client
            ->repositories()
            ->workspaces($repositoryName->workspace)
            ->hooks($repositoryName->name)
            ->create([
                'description' => config('app.name') . ' Webhook',
                'url' => route('webhook', ['sourceCodeAccount' => $account]),
                'events' => $events,
                'active' => true,
                'secret' => $secret,
            ]);

        $account->webhook_id = GetUuidFromJson::getUuid($webhook['uuid']);
        $account->webhook_secret = $secret;
        $account->save();
    }
}
