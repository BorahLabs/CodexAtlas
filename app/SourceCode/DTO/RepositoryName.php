<?php

namespace App\SourceCode\DTO;

class RepositoryName
{
    public readonly string $fullName;

    public function __construct(
        public readonly string $username,
        public readonly string $name,
        public readonly ?string $workspace = null,
    ) {
        if (empty($username)) {
            $this->fullName = $name;
            return;
        }

        $this->fullName = $username.'/'.$name;
    }
}
