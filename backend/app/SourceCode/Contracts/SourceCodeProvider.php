<?php

namespace App\SourceCode\Contracts;

use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;

interface SourceCodeProvider {
    /**
     * Returns a list of the repositories available in the provider
     *
     * @return Repository[]
     */
    public function repositories(): array;

    /**
     * Returns a the information of one repository
     *
     * @return Repository
     */
    public function repository(RepositoryName $repository): Repository;

    /**
     * Returns a list of the branches available in the repository
     *
     * @return Branch[]
     */
    public function branches(RepositoryName $repository): array;

    /**
     * Returns a list of the files in the repository, recursively
     *
     * @return File|Folder[]
     */
    public function files(RepositoryName $repository, Branch $branch, string $path): array;

    /**
     * Returns a single file and its contents
     *
     * @return File|Folder
     */
    public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder;
}
