<?php

namespace App\Actions\Github;

use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use GrahamCampbell\GitHub\Facades\GitHub;
use Lorisleiva\Actions\Concerns\AsAction;

class GetFile
{
    use AsAction;

    public function handle(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        // TODO:
        $rawFile = GitHub::repo()->contents()->show($repository->username, $repository->name, $path);

        if ($rawFile['type'] === 'dir') {
            return Folder::from($rawFile);
        }

        return File::from($rawFile);
    }
}
