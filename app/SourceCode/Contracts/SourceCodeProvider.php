<?php

namespace App\SourceCode\Contracts;

use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;

abstract class SourceCodeProvider
{
    private ?SourceCodeAccount $account;

    public function withCredentials(SourceCodeAccount $account): static
    {
        $this->setCredentials($account);

        return $this;
    }

    public function credentials(): SourceCodeAccount
    {
        return $this->account;
    }

    public function setCredentials(SourceCodeAccount $account): void
    {
        $this->account = $account;
    }

    /**
     * Returns a list of the repositories available in the provider
     *
     * @return Repository[]
     */
    abstract public function repositories(): array;

    /**
     * Returns a the information of one repository
     */
    abstract public function repository(RepositoryName $repository): Repository;

    /**
     * Returns a list of the branches available in the repository
     *
     * @return Branch[]
     */
    abstract public function branches(RepositoryName $repository): array;

    /**
     * Returns a list of the files in the repository, recursively
     *
     * @return File|Folder[]
     */
    abstract public function files(RepositoryName $repository, Branch $branch, ?string $path = null): array;

    /**
     * Returns a single file and its contents
     */
    abstract public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder;

    /**
     * Path to the view containing the icon of the provider
     */
    abstract public function icon(): string;

    /**
     * Path to the view containing the icon of the provider
     */
    public function circledIcon(): string
    {
        return $this->icon().'-circle';
    }

    public function circledClearGradientIcon(): string
    {
        return $this->icon().'-circle-clear-gradient';
    }

    /**
     * Name of the provider
     */
    abstract public function name(): string;

    /**
     * Returns a URL to the repository
     */
    abstract public function url(RepositoryName $repository): string;
}
