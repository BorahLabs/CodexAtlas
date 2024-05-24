<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\PHP;
use App\Atlas\Languages\Python;

class PythonToPHP extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new PHP());
    }
}
