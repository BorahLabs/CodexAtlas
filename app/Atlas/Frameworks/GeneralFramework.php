<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class GeneralFramework extends Framework
{
    public function name(): string
    {
        return 'Default';
    }

    public function usesFramework(Folder $folder): bool
    {
        return true;
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        return [
            '*.*',
        ];
    }

    public function ignorable(): array
    {
        return [
            '.*',
            '*/.*',
            '*.md',
            '.git*',
            'vendor/*',
            'node_modules/*',
            '__pycache__/*',
            'build/*',
            'dist/*',
            'public/*',
            'storage/*',
            'bootstrap/*',
            'tests/*',
            '*/vendor/*',
            '*/node_modules/*',
            '*/__pycache__/*',
            '*/build/*',
            '*/dist/*',
            '*/public/*',
            '*/storage/*',
        ];
    }
}
