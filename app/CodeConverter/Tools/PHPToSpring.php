<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Spring;
use App\Atlas\Languages\PHP;

class PHPToSpring extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Spring());
    }
}
