<?php

namespace App\SourceCode\DTO;

class RepositoryName
{
    public function __construct(
        public readonly string $username,
        public readonly string $name,
    ) {
    }
}
