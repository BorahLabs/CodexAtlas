<?php

namespace App\Actions\Github;

use App\SourceCode\DTO\Repository;
use GrahamCampbell\GitHub\Facades\GitHub;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllRepositories
{
    use AsAction;

    /**
     * @return Repository[]
     */
    public function handle(): array
    {
        return collect(GitHub::me()->repositories())
            ->map(fn ($repo) => new Repository(
                id: $repo['id'],
                name: $repo['name'],
                owner: $repo['owner']['login'],
                description: $repo['description'] ?? null,
            ))
            ->toArray();
    }
}
