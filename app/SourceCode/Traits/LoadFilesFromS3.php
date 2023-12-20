<?php

namespace App\SourceCode\Traits;

use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use App\SourceCode\S3ZipProvider;
use Illuminate\Support\Facades\Storage;

trait LoadFilesFromS3
{
    public function files(RepositoryName $repository, Branch $branch, string $path = null): array
    {
        $zipPath = $this->loadZipFile($repository, $branch);
        return (new S3ZipProvider())
            ->withCredentials($this->credentials())
            ->usingZipFile($zipPath)
            ->files($repository, $branch, $path);
    }

    public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        $zipPath = $this->loadZipFile($repository, $branch);
        return (new S3ZipProvider())
            ->withCredentials($this->credentials())
            ->usingZipFile($zipPath)
            ->file($repository, $branch, $path);
    }

    public function loadZipFile(RepositoryName $repository, Branch $branch): string
    {
        $zip = sha1($this->credentials()->id . '-' . $repository->fullName . '-' . $branch->name) . '.zip';
        $disk = Storage::disk('s3');
        if ($disk->exists($zip)) {
            $timeAgo = \Carbon\Carbon::createFromTimestamp($disk->lastModified($zip))->diffInRealSeconds(now());
            $maxTimeAgo = 60 * 15; // 15min
            if ($timeAgo < $maxTimeAgo) {
                return $zip;
            }

            $disk->delete($zip);
        }

        $this->archive($repository, $branch, $disk, $zip);

        return $zip;
    }
}
