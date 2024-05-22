<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\Services\GetUuidFromJson;
use App\SourceCode\DTO\Repository;
use Bitbucket\ResultPager;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchWorkspaces
{
    use AsAction;

    public function handle(SourceCodeAccount $account, string $query)
    {
        try {
            $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);

            $paginator = new ResultPager($client);

            $api = $client->currentUser();

            $workspaces = collect($paginator->fetch($api, 'listWorkspaces')['values']);

            $workspaces = $workspaces->filter(function (array $item) use (&$repos, $client, $paginator, $query) {
                if (!$query) {
                    return true;
                }
                $slug = $item['slug'];

                return  strpos($slug, $query) == 0;
            });

            return $workspaces->pluck('slug')->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }
}
