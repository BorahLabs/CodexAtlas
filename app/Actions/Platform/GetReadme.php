<?php

namespace App\Actions\Platform;

use App\Models\Branch;
use App\Models\Repository;
use App\SourceCode\DTO\File;
use Illuminate\Support\Facades\Cache;
use Lorisleiva\Actions\Concerns\AsAction;

class GetReadme
{
    use AsAction;

    public function handle(Repository $repository, Branch $branch): ?File
    {
        $key = 'readme-'.$repository->id.'-'.$branch->id;
        $file = Cache::get($key);
        if (is_null($file)) {

            try {
                $file = $repository->sourceCodeAccount->getProvider()->file(
                    repository: $repository->nameDto(),
                    branch: $branch->dto(),
                    path: 'README.md',
                );

                Cache::put($key, $file, now()->addMinutes(30));
            } catch (\Exception $e) {
                $file = null;
            }
        }

        return $file;
    }
}
