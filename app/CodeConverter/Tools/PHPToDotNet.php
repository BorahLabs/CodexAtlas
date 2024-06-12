<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\DotNet;
use App\Atlas\Languages\PHP;

class PHPToDotNet extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new DotNet());
    }
}
