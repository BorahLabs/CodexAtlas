<?php

namespace App\SourceCode\DTO;

class RepositoryName
{
    public readonly string $fullName;

    public function __construct(
        public readonly string $username,
        public readonly string $name,
    ) {
        $this->fullName = $username . '/' . $name;
    }
}
