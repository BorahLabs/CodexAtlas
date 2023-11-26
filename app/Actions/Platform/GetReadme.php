<?php

namespace App\Actions\Platform;

use App\Models\Branch;
use App\Models\Repository;
use App\SourceCode\DTO\File;
use Lorisleiva\Actions\Concerns\AsAction;

class GetReadme
{
    use AsAction;

    public function handle(Repository $repository, Branch $branch): File|null
    {
        try {
            $file = $repository->sourceCodeAccount->getProvider()->file(
                repository: $repository->nameDto(),
                branch: $branch->dto(),
                path: 'README.md',
            );
        } catch (\Exception $e) {
            $file = null;
        }

        return $file;
    }
}
