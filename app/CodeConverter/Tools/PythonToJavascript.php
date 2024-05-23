<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Python;
use App\Atlas\Languages\Javascript;

class PythonToJavascript extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Javascript());
    }
}
