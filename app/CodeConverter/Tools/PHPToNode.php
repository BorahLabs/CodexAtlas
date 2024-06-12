<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Node;
use App\Atlas\Languages\PHP;

class PHPToNode extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Node());
    }
}
