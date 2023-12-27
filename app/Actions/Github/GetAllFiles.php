<?php

namespace App\Actions\Github;

use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllFiles
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repository, Branch $branch, ?string $path = null): array
    {
        $client = GetAuthenticatedAccountGithubClient::make()->handle($account);
        /**
         * @var \Github\Api\Repo $api
         */
        $api = $client->api('repo');
        $rawFiles = $api->contents()->show($repository->username, $repository->name, $path, $branch->name);
        if (! isset($rawFiles[0]) && ! empty($rawFiles)) {
            $rawFiles = [$rawFiles];
        }

        $files = [];
        foreach ($rawFiles as $file) {
            if ($file['type'] === 'dir') {
                $folder = Folder::from($file);
                $children = $this->handle($account, $repository, $branch, $file['path']);
                foreach ($children as $child) {
                    if ($child instanceof File) {
                        $folder->addFile($child);
                    } else {
                        $folder->addFolder($child);
                    }
                }

                $files[] = $folder;
            } else {
                $files[] = File::from($file);
            }
        }

        return $files;
    }
}
