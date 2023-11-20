<?php

namespace App\Actions\Github;

use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use GrahamCampbell\GitHub\Facades\GitHub;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllFiles
{
    use AsAction;

    public function handle(RepositoryName $repository, Branch $branch, string $path = null): array
    {
        // TODO: Set branch
        $rawFiles = GitHub::repo()->contents()->show($repository->username, $repository->name, $path);
        if (! isset($rawFiles[0]) && ! empty($rawFiles)) {
            $rawFiles = [$rawFiles];
        }

        $files = [];
        foreach ($rawFiles as $file) {
            if ($file['type'] === 'dir') {
                $folder = Folder::from($file);
                $children = $this->handle($repository, $branch, $file['path']);
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
