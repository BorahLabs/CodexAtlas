<?php

namespace App\SourceCode\DTO;

class Repository
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $owner,
        public readonly ?string $description,
        public readonly ?string $workspace = null,
    ) {
    }
}
