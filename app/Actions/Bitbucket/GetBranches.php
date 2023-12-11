<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthApiHeaders;
use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class GetBranches
{
    use AsAction;

    /**
     * @return Branch[]
     */
    public function handle(SourceCodeAccount $account, RepositoryName $repository)
    {
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);

        $api = $client->repositories()->workspaces($repository->workspace)->refs($repository->name)->branches();

        $content = $api->list();
        $branches = [];
        $headers = GetAuthApiHeaders::run($account);

        $this->getAllBranches($content, $branches, $headers);

        return collect($branches)
            ->mapInto(Branch::class)
            ->toArray();
    }

    private function getAllBranches($content, &$branches, $headers)
    {
        foreach($content['values'] as $value)
        {
            $branches[] = $value['name'];
        }

        if(isset($content['next']) && $content['next'] != ''){
            $content = Http::withHeaders($headers)->get($content['next']);
            $this->getAllBranches(json_decode($content, true), $branches, $headers);
        }
    }
}
