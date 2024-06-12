<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Spring;
use App\Atlas\Languages\Python;

class PythonToSpring extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Spring());
    }
}
