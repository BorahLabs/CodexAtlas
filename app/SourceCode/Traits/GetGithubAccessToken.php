<?php

namespace App\SourceCode\Traits;

use App\Enums\SourceCodeProvider;
use App\Models\SourceCodeAccount;

trait GetGithubAccessToken {
    public function getAccessToken(): ?string
    {
        return SourceCodeAccount::query()
            ->where('provider', SourceCodeProvider::GitHub->value)
            ->where('name', $this->repositoryOwner)
            ->first()?->impersonate_token;
    }
}
