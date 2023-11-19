<?php

namespace App\Actions\Github;

use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use GrahamCampbell\GitHub\Facades\GitHub;
use Lorisleiva\Actions\Concerns\AsAction;

class GetRepository
{
    use AsAction;

    public function handle(RepositoryName $repository): Repository
    {
        $repo = GitHub::repo()->show($repository->username, $repository->name);
        return new Repository(
            id: $repo['id'],
            name: $repo['name'],
            owner: $repo['owner']['login'],
            description: $repo['description'] ?? null,
        );
    }
}
