<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Kotlin;
use App\Atlas\Languages\Python;

class PythonToKotlin extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Kotlin());
    }
}
