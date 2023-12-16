<?php

namespace App\SourceCode\Contracts;

use App\SourceCode\DTO\RepositoryName;

interface RegistersWebhook
{
    public function registerWebhook(RepositoryName $repository);
}
