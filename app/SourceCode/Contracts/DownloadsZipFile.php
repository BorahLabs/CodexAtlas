<?php

namespace App\SourceCode\Contracts;

use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Contracts\Filesystem\Filesystem;

interface DownloadsZipFile
{
    public function archive(RepositoryName $repository, Branch $branch, Filesystem $filesystem, string $zipPath): string;
    public function loadZipFile(RepositoryName $repository, Branch $branch): string;
}
