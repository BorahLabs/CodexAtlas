<?php

namespace App\Enums;

use App\SourceCode\BitbucketProvider;
use App\SourceCode\Contracts\SourceCodeProvider as ContractsSourceCodeProvider;
use App\SourceCode\GitHubProvider;
use App\SourceCode\GitLabProvider;

enum SourceCodeProvider: string {
    case GitHub = 'github';
    case GitLab = 'gitlab';
    case Bitbucket = 'bitbucket';

    public function provider(): ContractsSourceCodeProvider
    {
        return match($this) {
            static::GitHub => new GitHubProvider(),
            static::GitLab => new GitLabProvider(),
            static::Bitbucket => new BitbucketProvider(),
        };
    }
}
