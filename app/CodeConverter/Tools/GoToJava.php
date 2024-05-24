<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Go;
use App\Atlas\Languages\Java;

class GoToJava extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Go(), new Java());
    }
}
