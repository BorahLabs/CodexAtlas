<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Java;
use App\Atlas\Languages\Python;

class JavaToPython extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Java(), new Python());
    }
}
