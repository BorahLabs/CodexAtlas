<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Java;
use App\Atlas\Languages\Kotlin;

class KotlinToJava extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Kotlin(), new Java());
    }
}
