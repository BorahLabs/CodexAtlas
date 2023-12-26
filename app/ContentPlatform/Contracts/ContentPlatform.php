<?php

namespace App\ContentPlatform\Contracts;

use App\Models\SystemComponent;

abstract class ContentPlatform
{
    public abstract function handleSynchronizeAction(SystemComponent $systemComponent);
    public abstract function createPage(SystemComponent $systemComponent);
    public abstract function updatePage(SystemComponent $systemComponent);
    public abstract function renamePage(SystemComponent $systemComponent);
    public abstract function deletePage(SystemComponent $systemComponent);
}
