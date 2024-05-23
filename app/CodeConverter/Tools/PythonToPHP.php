<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Python;
use App\Atlas\Languages\PHP;

class PythonToPHP extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new PHP());
    }
}
