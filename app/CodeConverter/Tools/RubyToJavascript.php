<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Javascript;
use App\Atlas\Languages\Ruby;

class RubyToJavascript extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new Javascript());
    }
}
