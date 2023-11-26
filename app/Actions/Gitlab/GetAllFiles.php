<?php

namespace App\Actions\Gitlab;

use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
use App\Actions\Gitlab\GetProjectIdForRepository;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllFiles
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repository, Branch $branch, string $path = null): array
    {
        $client = GetAuthenticatedAccountGitlabClient::make()->handle($account);
        $projectId = GetProjectIdForRepository::make()->handle($account, $repository);
        $api = $client->repositories();
        $rawFiles = $api->tree($projectId, [
            // TODO: add branch?
        ]);

        // TODO: all
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
