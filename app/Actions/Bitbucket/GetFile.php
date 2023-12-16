<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
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
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);
        $branch = GetBranch::make()->handle($account, $repository, $branch);
        $api = $client
            ->repositories()
            ->workspaces($repository->workspace)
            ->src($repository->name);

        $contents = $api->download($branch->sha, $path)->getContents();

        return File::from([
            'name' => basename($path),
            'path' => $path,
            'sha' => sha1($contents),
            'download_url' => '',
            'content' => base64_encode($contents),
        ]);
    }
}
