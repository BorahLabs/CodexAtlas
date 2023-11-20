<?php

namespace App\Actions\LocalFolder;

use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Facades\File as FacadesFile;

// use Lorisleiva\Actions\Concerns\AsAction;

class GetAllFiles
{
    // use AsAction;

    public function handle(RepositoryName $repository, Branch $branch, ?string $path = null): array
    {
        $path = $path ? $repository->fullName . '/' . $path : $repository->fullName;
        $rawFiles = FacadesFile::files($path);
        $directories = FacadesFile::directories($path);

        $isBlacklisted = fn (string $p) => str($p)->contains(['node_modules', 'vendor']);

        $files = [];
        foreach ($rawFiles as $file) {
            if ($isBlacklisted($file->getPath())) {
                continue;
            }

            $files[] = File::from([
                'name' => $file->getBasename(),
                'path' => str($file->getPathname())->after($repository->fullName . '/')->toString(),
                'absolute_path' => $file->getPathname(),
                'sha' => sha1($file->getContents()),
                'download_url' => $file->getPath(),
            ]);
        }

        foreach ($directories as $directory) {
            if ($isBlacklisted($directory)) {
                continue;
            }

            $folder = Folder::from([
                'name' => basename($directory),
                'path' => str(dirname($directory))->after($repository->fullName . '/')->toString(),
                'absolute_path' => dirname($directory),
                'sha' => sha1($directory),
            ]);
            $children = $this->handle($repository, $branch, str($directory)->after($repository->fullName)->trim('/')->toString());
            foreach ($children as $child) {
                if ($child instanceof File) {
                    $folder->addFile($child);
                } else {
                    $folder->addFolder($child);
                }
            }

            $files[] = $folder;
        }

        return $files;
    }
}
