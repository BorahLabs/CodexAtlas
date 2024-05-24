<?php

namespace App\Actions\Gitlab;

use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Repository;
use Lorisleiva\Actions\Concerns\AsAction;

class SearchRepository
{
    use AsAction;

    public function handle(SourceCodeAccount $account, string $query)
    {
        /**
         * @var \GrahamCampbell\GitLab\GitLabManager $client
         */
        $client = GetAuthenticatedAccountGitlabClient::make()->handle($account);

        $repos = $client->projects()->all([
            'simple' => true,
            'search_namespaces' => true,
            'search' => $query,
            'membership' => true,
            'per_page' => 10,
        ]);

        return collect($repos)
            ->map(fn (array $repo) => new Repository(
                id: $repo['id'],
                name: $repo['name'],
                owner: $repo['namespace']['path'],
                description: $repo['description'] ?? null,
            ))
            ->toArray();
    }
}
