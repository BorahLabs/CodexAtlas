<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Go;
use App\Atlas\Languages\Ruby;

class GoToRuby extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Go(), new Ruby());
    }
}
