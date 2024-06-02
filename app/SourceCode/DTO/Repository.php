<?php

namespace App\SourceCode\DTO;

use Livewire\Wireable;

class Repository implements Wireable
{
    public readonly string $fullName;

    public final function __construct(
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

    public function toLivewire(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'owner' => $this->owner,
            'description' => $this->description,
            'workspace' => $this->workspace,
            'fullName' => $this->fullName,
        ];
    }

    /**
     * @var array $value
     */
    public static function fromLivewire($value): static
    {
        $id = $value['id'];
        $name = $value['name'];
        $owner = $value['owner'];
        $description = $value['description'];
        $workspace = $value['workspace'];

        return new static($id, $name, $owner, $description, $workspace);
    }
}
