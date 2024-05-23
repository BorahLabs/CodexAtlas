<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\Services\GetUuidFromJson;
use App\SourceCode\DTO\Repository;
use Bitbucket\ResultPager;
use Illuminate\Support\Collection;
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

            $workspaces = $workspaces
                            ->when(!empty($query),
                            fn (Collection $collection) => $collection->filter(fn (array $item) => str_contains($item['slug'], $query)));

            return $workspaces->pluck('slug')->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }
}
