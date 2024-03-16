<?php

namespace App\Atlas\Frameworks\Contracts;

use App\SourceCode\DTO\Folder;

abstract class FrameworkWithDependencyFiles extends Framework
{
    abstract public function getDependencyFilePath(): string;

    abstract public function getDependencies(): array;

    public function hasDependencies(Folder $folder): bool
    {
        $fileContent = $folder->getFile($this->getDependencyFilePath())?->contents();

        return str($fileContent)->containsAll($this->getDependencies());
    }
}
