<?php

namespace App\Exceptions;

use Exception;

class ExceededProviderRateLimit extends Exception
{
    public function __construct(
        public readonly int $retryInSeconds
    ) {
        parent::__construct('Exceeded provider rate limit.', 429);
    }
}
