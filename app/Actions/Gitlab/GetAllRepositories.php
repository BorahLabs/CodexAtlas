<?php

namespace App\Actions\Gitlab;

use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Repository;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllRepositories
{
    use AsAction;

    /**
     * @return Repository[]
     */
    public function handle(SourceCodeAccount $account): array
    {
        /**
         * @var \GrahamCampbell\GitLab\GitLabManager $client
         */
        $client = GetAuthenticatedAccountGitlabClient::make()->handle($account);
        $repos = $client->projects()->all([
            'membership' => true,
        ]);

        return collect($repos)
            ->map(fn ($repo) => new Repository(
                id: $repo['id'],
                name: $repo['name'],
                owner: explode('/', $repo['path_with_namespace'])[0],
                description: $repo['description'] ?? null,
            ))
            ->toArray();
    }
}
