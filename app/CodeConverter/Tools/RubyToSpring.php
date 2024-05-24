<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Ruby;
use App\Atlas\Frameworks\Spring;

class RubyToSpring extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new Spring());
    }
}
