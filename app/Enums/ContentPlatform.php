<?php

namespace App\Enums;

use App\ContentPlatform\ConfluenceContentPlatform;
use App\ContentPlatform\Contracts\ContentPlatform as ContractsContentPlatform;

enum ContentPlatform: string
{
    case Confluence = 'confluence';

    public function provider(): ContractsContentPlatform
    {
        return match($this) {
            static::Confluence => new ConfluenceContentPlatform(),
        };
    }
}
