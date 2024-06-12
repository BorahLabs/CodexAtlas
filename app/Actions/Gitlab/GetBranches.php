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
    public function handle(SourceCodeAccount $account, RepositoryName $repository): array
    {
        /**
         * @var \GrahamCampbell\GitLab\GitLabManager $client
         */
        $client = GetAuthenticatedAccountGitlabClient::make()->handle($account);
        $projectId = GetProjectIdForRepository::make()->handle($account, $repository);
        $branches = $client->repositories()->branches($projectId, [
            'per_page' => 100,
        ]);

        return collect($branches)
            ->map(fn (array $branch) => $branch['name'])
            ->mapInto(Branch::class)
            ->toArray();
    }
}
