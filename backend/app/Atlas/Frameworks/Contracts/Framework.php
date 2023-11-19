<?php

namespace App\Atlas\Frameworks\Contracts;

use App\SourceCode\DTO\Folder;

interface Framework {
    public function name(): string;

    public function usesFramework(Folder $folder): bool;

    public function customContext(): ?string;
}
