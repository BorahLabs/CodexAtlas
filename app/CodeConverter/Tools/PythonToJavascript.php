<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Javascript;
use App\Atlas\Languages\Python;

class PythonToJavascript extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Javascript());
    }
}
