<?php

namespace App\Actions\Autodoc;

use App\Actions\LocalFolder\GetAllFiles;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class GetFiles
{
    use AsAction;

    public function handle(string $baseName): array
    {
        $absolutePath = Storage::disk('tmp')->path($baseName);
        $repoName = '';
        do {
            $directories = collect(Storage::disk('tmp')->directories($baseName.DIRECTORY_SEPARATOR.$repoName))
                ->filter(fn (string $directory) => ! str($directory)->endsWith('.git') && ! str($directory)->contains('__MACOSX'))
                ->values()
                ->all();
            if (count($directories) !== 1) {
                break;
            }

            $repoName = $directories[0];
        } while (count($directories) === 1);

        $repoName = str($repoName)->after($baseName.DIRECTORY_SEPARATOR)->toString();
        $repository = new RepositoryName(
            username: $absolutePath,
            name: $repoName,
        );
        $files = GetAllFiles::make()->handle(
            repository: $repository,
            branch: new Branch(name: 'main'),
        );

        return [$repository, $files];
    }
}
