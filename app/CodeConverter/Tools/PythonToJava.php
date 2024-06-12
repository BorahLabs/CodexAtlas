<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Java;
use App\Atlas\Languages\Python;

class PythonToJava extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Java());
    }
}
