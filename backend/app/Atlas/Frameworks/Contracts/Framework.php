<?php

namespace App\Atlas\Frameworks\Contracts;

use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

abstract class Framework {
    public abstract function name(): string;

    public abstract function usesFramework(Folder $folder): bool;

    public abstract function customContext(): ?string;

    public function mightBeRelevant(string $path): bool
    {
        foreach ($this->relevant() as $file) {
            if (str($path)->is($file)) {
                return true;
            }
        }

        return false;
    }

    public function shouldBeIgnored(string $path): bool
    {
        foreach ($this->ignorable() as $file) {
            if (str($path)->is($file)) {
                return true;
            }
        }

        return false;
    }

    /**
     * File patterns to be ignored
     *
     * @return string[]
     */
    public abstract function ignorable(): array;

    /**
     * File patterns to be considered as useful
     *
     * @return string[]
     */
    public abstract function relevant(): array;
}
