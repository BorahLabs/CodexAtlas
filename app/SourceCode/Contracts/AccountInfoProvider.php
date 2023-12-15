<?php

namespace App\SourceCode\Contracts;

use App\SourceCode\DTO\Account;

interface AccountInfoProvider
{
    public function account(): Account;
}
