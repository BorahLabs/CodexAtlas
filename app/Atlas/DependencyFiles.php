<?php

namespace App\Atlas;

use App\SourceCode\DTO\Folder;

class DependencyFiles {

    const DEPENDENCY_FILES = [
        'composer.json',
        'package.json',
        'requirements.txt',
        'Podfile'
    ];

    public static function getFolderDependencyFiles(Folder $folder) : array
    {
        return array_filter(self::DEPENDENCY_FILES, fn(string $dependencyFile) => $folder->hasFile($dependencyFile));
    }
}
