<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Go;
use App\Atlas\Languages\Ruby;

class RubyToGo extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new Go());
    }
}
