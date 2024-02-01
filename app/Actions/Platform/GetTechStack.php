<?php

namespace App\Actions\Platform;

use App\Atlas\DependencyFiles;
use App\Models\Branch;
use App\Models\Repository;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch as DTOBranch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Console\Command;
use Lorisleiva\Actions\Concerns\AsAction;
use Psy\Util\Str;

class GetTechStack
{
    use AsAction;

    public string $commandSignature = 'get:tech-stack';

    public function handle(Repository $repository, Branch $branch): ?File
    {
        $provider = $repository->sourceCodeAccount->getProvider();
        $repositoryName = $repository->nameDto();
        $branchName = $branch->name;

        $dependencyFiles = $this->getDependencyFiles($provider, $repositoryName, $branchName);
        dd($dependencyFiles);

    }

    public function asCommand(Command $command): void
    {
        $this->handle(
            Repository::first(),
            Branch::first()
        );

        $command->info('Done!');
    }

    private function getDependencyFiles(SourceCodeProvider $provider, RepositoryName $repositoryName, string $branchName) : array
    {
        $filesAndFolders = $provider->files(
            repository: $repositoryName,
            branch: new DTOBranch(name: $branchName),
            path: null,
        );
        $folder = Folder::makeWithFiles($filesAndFolders, $repositoryName->name, $repositoryName->username, sha1($repositoryName->fullName));
        $dependencyFileNames = DependencyFiles::getFolderDependencyFiles($folder);

        $dependencyFiles = [];

        foreach($dependencyFileNames as $dependencyFileName) {
            $dependencyFiles[] = $provider->file($repositoryName, new DTOBranch(name:$branchName), $dependencyFileName);
        }

        return $dependencyFiles;
    }

}
