<?php

namespace App\Actions\Github;

use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use GrahamCampbell\GitHub\Facades\GitHub;
use Lorisleiva\Actions\Concerns\AsAction;

class GetFile
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        $client = GetAuthenticatedAccountGithubClient::make()->handle($account);
        /**
         * @var \Github\Api\Repo $api
         */
        $api = $client->api('repo');
        $rawFile = $api->contents()->show($repository->username, $repository->name, $path, $branch->name);

        if ($rawFile['type'] === 'dir') {
            return Folder::from($rawFile);
        }

        return File::from($rawFile);
    }
}
