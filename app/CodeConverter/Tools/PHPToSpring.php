<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\PHP;
use App\Atlas\Frameworks\Spring;

class PHPToSpring extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Spring());
    }
}
