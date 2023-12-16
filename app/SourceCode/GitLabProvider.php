<?php

namespace App\SourceCode;

use App\Actions\Gitlab;
use App\Exceptions\ExceededProviderRateLimit;
use App\SourceCode\Contracts\AccountInfoProvider;
use App\SourceCode\Contracts\HandlesWebhook;
use App\SourceCode\Contracts\RegistersWebhook;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Account;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use Gitlab\Exception\ApiLimitExceededException;
use Illuminate\Http\Request;

class GitLabProvider extends SourceCodeProvider implements AccountInfoProvider, RegistersWebhook, HandlesWebhook
{
    public function repositories(): array
    {
        try {
            return Gitlab\GetAllRepositories::make()->handle($this->credentials());
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(3600);
        }
    }

    public function repository(RepositoryName $repository): Repository
    {
        try {
            return Gitlab\GetRepository::make()->handle($this->credentials(), $repository);
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(3600);
        }
    }

    public function branches(RepositoryName $repository): array
    {
        try {
            return Gitlab\GetBranches::make()->handle($this->credentials(), $repository);
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(3600);
        }
    }

    public function files(RepositoryName $repository, Branch $branch, string $path = null): array
    {
        try {
            return Gitlab\GetAllFiles::make()->handle($this->credentials(), $repository, $branch, $path);
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(3600);
        }
    }

    public function file(RepositoryName $repository, Branch $branch, string $path): File|Folder
    {
        try {
            return Gitlab\GetFile::make()->handle($this->credentials(), $repository, $branch, $path);
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(3600);
        }
    }

    public function icon(): string
    {
        return 'codex.icons.gitlab';
    }

    public function name(): string
    {
        return 'Gitlab';
    }

    public function url(RepositoryName $repository): string
    {
        return 'https://gitlab.com/'.$repository->fullName;
    }

    public function account(): Account
    {
        return Gitlab\GetAccount::make()->handle($this->credentials());
    }

    public function registerWebhook(RepositoryName $repository)
    {
        return Gitlab\RegisterWebhook::make()->handle($this->credentials(), $repository);
    }

    public function verifyIncomingWebhook(Request $request)
    {
        return Gitlab\VerifyWebhook::make()->handle($this->credentials(), $request);
    }

    public function handleIncomingWebhook(array $payload, Request $request)
    {
        return Gitlab\HandleWebhook::make()->handle($this->credentials(), $payload, $request);
    }
}
