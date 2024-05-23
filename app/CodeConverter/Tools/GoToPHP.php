<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Go;
use App\Atlas\Languages\PHP;

class GoToPHP extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Go(), new PHP());
    }
}
