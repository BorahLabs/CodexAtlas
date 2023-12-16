<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Decorators\Bitbucket\DecoratedSrc;
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
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);

        $paginator = new ResultPager($client);

        $branch = GetBranch::make()->handle($account, $repository, $branch);

        $api = $client
            ->repositories()
            ->workspaces($repository->workspace)
            ->src($repository->name);
        $api = new DecoratedSrc($api, $repository->workspace, $repository->name);

        $rawFiles = $paginator->fetch($api, 'list', [$branch->sha, $path ?? '/']);

        $files = [];
        foreach ($rawFiles['values'] as $file) {
            if ($file['type'] === 'commit_directory') {
                $folder = Folder::from([
                    'name' => basename($file['path']),
                    'path' => $file['path'],
                    'sha' => '', // not sent by bitbucket
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
                    'name' => basename($file['path']),
                    'path' => $file['path'],
                    'sha' => '', // not sent by bitbucket
                    'download_url' => '',
                ]);
            }
        }

        return $files;
    }
}
