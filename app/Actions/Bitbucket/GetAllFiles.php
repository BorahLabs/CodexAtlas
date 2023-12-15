<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
use App\Actions\Gitlab\GetProjectIdForRepository;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use Bitbucket\ResultPager;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllFiles
{
    use AsAction;

    public function handle(SourceCodeAccount $account, RepositoryName $repository, Branch $branch, string $path = null): array
    {
        // TODO: Bucle para recorrer todos los ficheros. Descubrir como ver los ficheros de una rama concreta
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);

        // $api = $client->repositories()->workspaces($repository->workspace)->src($repository->name)->list(['branch' => 'master']);

        // PUEDE QUE SEA ASI HACE FALTA EL FILEPATH
        // $api2 = $client->repositories()->workspaces($repository->workspace)->src($repository->name)->show('README.md', 'README.md',['branch' => 'master']);

        $paginator = new ResultPager($client);

        $api = $client->repositories()
            ->workspaces($repository->workspace)
            ->src($repository->name);

        $branches = $paginator->fetchAll($api, 'list');

        return [];
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
