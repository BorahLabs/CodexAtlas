<?php

namespace App\Enums;

enum SystemComponentStatus: string
{
    case Pending = 'pending';
    case Generating = 'generating';
    case Generated = 'generated';
    case Error = 'error';
    case Regenerating = 'regenerating';

    public function isError(): bool
    {
        return $this === self::Error;
    }
}
