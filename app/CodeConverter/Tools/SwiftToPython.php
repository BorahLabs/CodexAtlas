<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Python;
use App\Atlas\Languages\Swift;

class SwiftToPython extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Swift(), new Python());
    }
}
