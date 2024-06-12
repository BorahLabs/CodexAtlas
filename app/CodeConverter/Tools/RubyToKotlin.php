<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Kotlin;
use App\Atlas\Languages\Ruby;

class RubyToKotlin extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new Kotlin());
    }
}
