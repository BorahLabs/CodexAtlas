<?php

namespace App\ContentPlatform;

use App\ContentPlatform\Contracts\ContentPlatform;
use App\Models\SystemComponent;

class ConfluenceContentPlatform extends ContentPlatform
{
    public function createPage(SystemComponent $systemComponent)
    {
        throw new \Exception('Not implemented');
    }

    public function updatePage(SystemComponent $systemComponent)
    {
        throw new \Exception('Not implemented');
    }

    public function renamePage(SystemComponent $systemComponent)
    {
        throw new \Exception('Not implemented');
    }

    public function deletePage(SystemComponent $systemComponent)
    {
        throw new \Exception('Not implemented');
    }
}
