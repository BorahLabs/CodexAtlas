<?php

namespace App\Enums;

use App\SourceCode\BitbucketProvider;
use App\SourceCode\Contracts\SourceCodeProvider as ContractsSourceCodeProvider;
use App\SourceCode\DTO\RepositoryName;
use App\SourceCode\GitHubProvider;
use App\SourceCode\GitLabProvider;
use App\SourceCode\LocalFolderProvider;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum SourceCodeProvider: string implements HasLabel, HasIcon
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

    public function repositoryName(string $fromName): RepositoryName
    {
        if (substr_count($fromName, '/') === 1) {
            [$username, $name] = explode('/', $fromName);

            return new RepositoryName($username, $name, $this->canHaveWorkspace() ? $username : null);
        }

        if (substr_count($fromName, '/') === 2) {
            [$workspace, $username, $name] = explode('/', $fromName);

            return new RepositoryName($username, $name, $this->canHaveWorkspace() ? $workspace : null);
        }

        throw new \Exception('Invalid repository name.');
    }

    public function canHaveWorkspace(): bool
    {
        return $this === self::Bitbucket;
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::GitHub => 'Github',
            self::GitLab => 'Gitlab',
            self::Bitbucket => 'Bitbucket',
            self::LocalFolder => 'Local Folder',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::GitHub => 'icon-github',
            self::GitLab => 'icon-gitlab',
            self::Bitbucket => 'icon-bitbucket',
            self::LocalFolder => 'heroicon-o-clipboard',
        };
    }
}
