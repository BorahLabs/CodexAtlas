<?php

namespace App\Actions\Gitlab;

use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use Lorisleiva\Actions\Concerns\AsAction;

class GetFile
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        /**
         * @var \GrahamCampbell\GitLab\GitLabManager $client
         */
        $client = GetAuthenticatedAccountGitlabClient::make()->handle($account);
        $projectId = GetProjectIdForRepository::make()->handle($account, $repository);
        $rawFile = $client->repositoryFiles()->getFile($projectId, $path, $branch->name);
        // TODO:
        dd($rawFile);
        if ($rawFile['type'] === 'dir') {
            return Folder::from($rawFile);
        }

        return File::from($rawFile);
    }
}
