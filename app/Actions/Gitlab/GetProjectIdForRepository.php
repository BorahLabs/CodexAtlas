<?php

namespace App\Actions\Gitlab;

use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use Lorisleiva\Actions\Concerns\AsAction;

class GetProjectIdForRepository
{
    use AsAction;

    /**
     * @return Branch[]
     */
    public function handle(SourceCodeAccount $account, RepositoryName $repository): string|int
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

        return $repo[0]['id'];
    }
}
