<?php

namespace App\Actions\Gitlab;

use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use Lorisleiva\Actions\Concerns\AsAction;

class GetBranches
{
    use AsAction;

    /**
     * @return Branch[]
     */
    public function handle(SourceCodeAccount $account, RepositoryName $repository)
    {
        /**
         * @var \GrahamCampbell\GitLab\GitLabManager $client
         */
        $client = GetAuthenticatedAccountGitlabClient::make()->handle($account);
        $repo = $client->projects()->all([
            'membership' => true,
            'search' => $repository->fullName,
            'search_namespaces' => true,
        ]);

        if (empty($repo)) {
            throw new \Exception('Repository '.$repository->fullName.' not found');
        }

        $branches = $client->repositories()->branches($repo[0]['id']);

        return collect($branches)
            ->map(fn ($branch) => $branch['name'])
            ->mapInto(Branch::class)
            ->toArray();
    }
}
