<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Python;
use App\Atlas\Languages\Java;

class PythonToJava extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Java());
    }
}
