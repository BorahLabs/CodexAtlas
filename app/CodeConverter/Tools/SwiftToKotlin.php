<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Kotlin;
use App\Atlas\Languages\Swift;

class SwiftToKotlin extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Swift(), new Kotlin());
    }
}
