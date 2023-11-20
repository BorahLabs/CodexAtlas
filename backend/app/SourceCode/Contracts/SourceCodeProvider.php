<?php

namespace App\SourceCode\Contracts;

use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;

abstract class SourceCodeProvider {
    private ?SourceCodeAccount $account;

    public function withCredentials(SourceCodeAccount $account)
    {
        $this->setCredentials($account);
        return $this;
    }

    public function credentials(): SourceCodeAccount
    {
        return $this->account;
    }

    public function setCredentials(SourceCodeAccount $account)
    {
        $this->account = $account;
    }

    /**
     * Returns a list of the repositories available in the provider
     *
     * @return Repository[]
     */
    public abstract function repositories(): array;

    /**
     * Returns a the information of one repository
     *
     * @return Repository
     */
    public abstract function repository(RepositoryName $repository): Repository;

    /**
     * Returns a list of the branches available in the repository
     *
     * @return Branch[]
     */
    public abstract function branches(RepositoryName $repository): array;

    /**
     * Returns a list of the files in the repository, recursively
     *
     * @return File|Folder[]
     */
    public abstract function files(RepositoryName $repository, Branch $branch, ?string $path = null): array;

    /**
     * Returns a single file and its contents
     *
     * @return File|Folder
     */
    public abstract function file(RepositoryName $repository, Branch $branch, string $path): File|Folder;
}
