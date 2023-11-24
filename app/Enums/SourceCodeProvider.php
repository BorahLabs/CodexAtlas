<?php

namespace App\Enums;

use App\SourceCode\BitbucketProvider;
use App\SourceCode\Contracts\SourceCodeProvider as ContractsSourceCodeProvider;
use App\SourceCode\GitHubProvider;
use App\SourceCode\GitLabProvider;
use App\SourceCode\LocalFolderProvider;

enum SourceCodeProvider: string
{
    case GitHub = 'github';
    case GitLab = 'gitlab';
    case Bitbucket = 'bitbucket';
    case LocalFolder = 'local';

    public function provider(): ContractsSourceCodeProvider
    {
        return match ($this) {
            self::GitHub => new GitHubProvider(),
            self::GitLab => new GitLabProvider(),
            self::Bitbucket => new BitbucketProvider(),
            self::LocalFolder => new LocalFolderProvider(),
        };
    }
}
