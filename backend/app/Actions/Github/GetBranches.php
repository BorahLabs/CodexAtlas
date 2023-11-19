<?php

namespace App\Actions\Github;

use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use GrahamCampbell\GitHub\Facades\GitHub;
use Lorisleiva\Actions\Concerns\AsAction;

class GetBranches
{
    use AsAction;

    /**
     * @return Branch[]
     */
    public function handle(RepositoryName $repository)
    {
        return collect(GitHub::gitData()->references()->branches($repository->username, $repository->name))
            ->map(fn ($branch) => new Branch($branch['name']))
            ->toArray();
    }
}
