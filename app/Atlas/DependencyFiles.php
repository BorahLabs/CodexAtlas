<?php

namespace App\Atlas;

use App\Models\Branch;
use App\SourceCode\DTO\Branch as DTOBranch;
use App\SourceCode\DTO\Folder;

class DependencyFiles
{
    const DEPENDENCY_FILES = [
        'composer.json',
        'package.json',
        'requirements.txt',
        'Podfile',
    ];

    public static function getFolderDependencyFiles(Folder $folder): array
    {
        return array_filter(self::DEPENDENCY_FILES, fn (string $dependencyFile) => $folder->hasFile($dependencyFile));
    }

    public static function getDependencyFilesFromBranch(Branch $branch): array
    {
        $repository = $branch->repository;
        $provider = $repository->sourceCodeAccount->getProvider();
        $repositoryName = $repository->nameDto();
        $branchName = $branch->name;

        $filesAndFolders = $provider->files(
            repository: $repositoryName,
            branch: new DTOBranch(name: $branchName),
            path: null,
        );
        $folder = Folder::makeWithFiles($filesAndFolders, $repositoryName->name, $repositoryName->username, sha1($repositoryName->fullName));
        $dependencyFileNames = self::getFolderDependencyFiles($folder);

        $dependencyFiles = [];

        foreach ($dependencyFileNames as $dependencyFileName) {
            $dependencyFiles[] = $provider->file($repositoryName, new DTOBranch(name: $branchName), $dependencyFileName);
        }

        return $dependencyFiles;
    }
}
