<?php

namespace App\SourceCode\DTO\Atlas;

class NavigationItem
{
    public function __construct(
        public readonly string $name,
        public readonly string $url,
    ) {
        //
    }
}
