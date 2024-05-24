<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Javascript;
use App\Atlas\Languages\Swift;

class SwiftToJavascript extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Swift(), new Javascript());
    }
}
