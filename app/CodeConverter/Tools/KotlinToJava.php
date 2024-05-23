<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Kotlin;
use App\Atlas\Languages\Java;

class KotlinToJava extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Kotlin(), new Java());
    }
}
