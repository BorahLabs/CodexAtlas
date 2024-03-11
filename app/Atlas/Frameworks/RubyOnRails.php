<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\SourceCode\DTO\Folder;

class RubyOnRails extends Framework
{
    public function name(): string
    {
        return 'Ruby on Rails';
    }

    public function imageUrl(): ?string
    {
        return asset('logos/rails.svg');
    }

    public function usesFramework(Folder $folder): bool
    {
        return $folder->hasFile('Rakefile') && $folder->hasFile('Gemfile') && $folder->hasFolder('app');
    }

    public function customContext(): ?string
    {
        return null;
    }

    public function relevant(): array
    {
        return [
            'app/*.rb',
            'app/*.erb',
        ];
    }

    public function ignorable(): array
    {
        return [];
    }
}
