<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Dart;
use App\Atlas\Languages\Go;

class GoToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Go(), new Dart());
    }
}
