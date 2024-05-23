<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Python;
use App\Atlas\Frameworks\Spring;

class PythonToSpring extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Spring());
    }
}
