<?php

namespace App\Actions\Gitlab;

use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use GrahamCampbell\GitLab\Facades\GitLab;
use Lorisleiva\Actions\Concerns\AsAction;

class GetRepository
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repository): Repository
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

        $repo = $repo[0];

        return new Repository(
            id: $repo['id'],
            name: $repo['name'],
            owner: explode('/', $repo['path_with_namespace'])[0],
            description: $repo['description'] ?? null,
        );
    }
}
