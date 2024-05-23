<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Python;
use App\Atlas\Languages\Ruby;

class PythonToRuby extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Ruby());
    }
}
