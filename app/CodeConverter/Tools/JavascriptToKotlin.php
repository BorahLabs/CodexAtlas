<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Javascript;
use App\Atlas\Languages\Kotlin;

class JavascriptToKotlin extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Javascript(), new Kotlin());
    }
}
