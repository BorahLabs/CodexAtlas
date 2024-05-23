<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Python;
use App\Atlas\Languages\Go;

class PythonToGo extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Go());
    }
}
