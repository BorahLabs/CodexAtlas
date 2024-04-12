<?php

namespace App\SourceCode\DTO;

class Repository
{
    public readonly string $fullName;

    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $owner,
        public readonly ?string $description,
        public readonly ?string $workspace = null,
    ) {
        if (empty($owner)) {
            $this->fullName = $name;

            return;
        }

        $this->fullName = $owner.'/'.$name;
    }
}
