<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Java;
use App\Atlas\Languages\PHP;

class PHPToJava extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Java());
    }
}
