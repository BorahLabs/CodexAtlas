<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class Angular extends Framework
{
    public function name(): string
    {
        return 'Angular';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/angular.svg');
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('angular.json') && $folder->hasFile('package.json');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        return [
            '*.ts',
            '*.html',
            '*.scss',
            '*.css',
            '*.js',
        ];
    }

    public function ignorable(): array
    {
        return [
            '*.spec.*',
            '*.e2e-spec.*',
            'karma.conf.*',
        ];
    }
}
