<?php

namespace App\Services;

use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
use App\Actions\Gitlab\GetProjectIdForRepository;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;

class GetUuidFromJson
{
    public static function getUuid($uuid): string
    {
        return str_replace(['{', '}'], '', $uuid);
    }

    public function handle(SourceCodeAccount $account, RepositoryName $repository, Branch $branch, string $path = null): array
    {
        // TODO ACTUALIZAR
        $client = GetAuthenticatedAccountGitlabClient::make()->handle($account);
        $projectId = GetProjectIdForRepository::make()->handle($account, $repository);
        $api = $client->repositories();
        $rawFiles = $api->tree($projectId, [
            'ref' => $branch->name,
            'path' => $path,
            'per_page' => 100,
        ]);

        $files = [];
        foreach ($rawFiles as $file) {
            if ($file['type'] === 'tree') {
                $folder = Folder::from([
                    'name' => $file['name'],
                    'path' => $file['path'],
                    'sha' => $file['id'],
                ]);
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
                $files[] = File::from([
                    'name' => $file['name'],
                    'path' => $file['path'],
                    'sha' => $file['id'],
                    'download_url' => '',
                ]);
            }
        }

        return $files;
    }
}
