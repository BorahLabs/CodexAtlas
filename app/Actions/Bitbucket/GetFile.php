<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthApiHeaders;
use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class GetFile
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        // TODO
        $response = Http::withHeaders(GetAuthApiHeaders::run($account))->get('https://api.bitbucket.org/2.0/repositories/' . $repository->workspace . '/' . $repository->name. '/src/' . $branch->name . '/' . $path);

        $content = json_decode($response->body(), true);
        /**
         * @var \Github\Api\Repo $api
         */

        if ($content['type'] === 'dir') {
            return Folder::from($content);
        }

        return File::from($content);
    }
}
