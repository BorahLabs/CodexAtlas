<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Spring;
use App\Atlas\Languages\Ruby;

class RubyToSpring extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new Spring());
    }
}
