<?php

namespace App\SourceCode;

use App\SourceCode\Contracts\ReceivesZipFile;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class S3ZipProvider extends SourceCodeProvider implements ReceivesZipFile
{
    protected ?string $localPath = null;

    public function repositories(): array
    {
        throw new \Exception('This method should not be used directly, but through another provider.');
    }

    public function repository(RepositoryName $repository): Repository
    {
        return new Repository(
            id: $repository->fullName,
            name: $repository->name,
            owner: $repository->username,
            description: null,
        );
    }

    public function branches(RepositoryName $repository): array
    {
        return [
            new Branch(name: 'main'),
        ];
    }

    public function files(RepositoryName $repository, Branch $branch, ?string $path = null): array
    {
        abort_if($this->localPath === null, 500, 'No zip file has been loaded yet.');
        $localRepository = (new LocalFolderProvider())->withCredentials($this->credentials());
        $localRepositoryName = new RepositoryName(
            username: '',
            name: Storage::disk('tmp')->path($this->localPath),
        );

        return $localRepository->files($localRepositoryName, $branch, $path);
    }

    public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        abort_if($this->localPath === null, 500, 'No zip file has been loaded yet.');
        $localRepository = (new LocalFolderProvider())->withCredentials($this->credentials());
        $localRepositoryName = new RepositoryName(
            username: '',
            name: Storage::disk('tmp')->path($this->localPath),
        );

        return $localRepository->file($localRepositoryName, $branch, $path);
    }

    public function downloadZipFile(string $zipFile): string
    {
        $local = Storage::disk('tmp');
        $s3 = Storage::disk('s3');
        $local->writeStream($zipFile, $s3->readStream($zipFile));

        return $local->path($zipFile);
    }

    public function usingZipFile(string $zipFile): static
    {
        $path = str(basename($zipFile))->beforeLast('.zip')->toString();
        if (Storage::disk('tmp')->exists($path)) {
            $this->localPath = $path;

            return $this;
        }

        $zipFilePath = $this->downloadZipFile($zipFile);
        $zip = new ZipArchive();
        $res = $zip->open($zipFilePath);
        if ($res !== true) {
            throw new \Exception('Could not open zip file');
        }

        if (Storage::disk('tmp')->exists($path)) {
            Storage::disk('tmp')->deleteDirectory($path);
        }

        $absolutePath = Storage::disk('tmp')->path($path);
        $zip->extractTo($absolutePath);
        $zip->close();
        unlink($zipFilePath);

        // Move all files and folders to the root of the zip
        do {
            $files = Storage::disk('tmp')->files($path);
            $folders = Storage::disk('tmp')->directories($path);
            if (count($folders) === 0) {
                break;
            }

            $subfolderFiles = Storage::disk('tmp')->files($folders[0]);
            $subfolderFolders = Storage::disk('tmp')->directories($folders[0]);
            foreach ($subfolderFiles as $file) {
                $newPath = str($file)->after($folders[0].'/')->toString();
                Storage::disk('tmp')->move($file, $path.'/'.$newPath);
            }

            foreach ($subfolderFolders as $folder) {
                $newPath = str($folder)->after($folders[0].'/')->toString();
                Storage::disk('tmp')->move($folder, $path.'/'.$newPath);
            }

            Storage::disk('tmp')->deleteDirectory($folders[0]);
        } while (count($folders) === 1 && count($files) === 0);

        $this->localPath = $path;

        return $this;
    }

    public function icon(): string
    {
        throw new \Exception('This should not be displayed in the UI');
    }

    public function name(): string
    {
        throw new \Exception('This should not be displayed in the UI');
    }

    public function url(RepositoryName $repository): string
    {
        throw new \Exception('This should not be displayed in the UI');
    }
}
