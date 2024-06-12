<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Python;
use App\Atlas\Languages\Ruby;

class RubyToPython extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new Python());
    }
}
