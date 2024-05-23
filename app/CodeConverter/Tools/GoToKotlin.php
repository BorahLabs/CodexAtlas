<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Go;
use App\Atlas\Languages\Kotlin;

class GoToKotlin extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Go(), new Kotlin());
    }
}
