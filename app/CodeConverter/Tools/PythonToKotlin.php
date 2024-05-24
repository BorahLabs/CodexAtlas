<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Python;
use App\Atlas\Languages\Kotlin;

class PythonToKotlin extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Kotlin());
    }
}
