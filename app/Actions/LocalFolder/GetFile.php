<?php

namespace App\Actions\LocalFolder;

use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\File as FacadesFile;
use Lorisleiva\Actions\Concerns\AsAction;

class GetFile
{
    use AsAction;

    public function handle(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        $path = $repository->fullName.DIRECTORY_SEPARATOR.$path;
        $file = FacadesFile::get($path);

        return File::from([
            'name' => basename($path),
            'path' => str($path)->after($repository->fullName.DIRECTORY_SEPARATOR)->toString(),
            'sha' => sha1($file),
            'download_url' => $path,
            'content' => base64_encode($file),
        ]);
    }
}
