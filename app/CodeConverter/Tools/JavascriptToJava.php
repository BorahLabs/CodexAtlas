<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Java;
use App\Atlas\Languages\Javascript;

class JavascriptToJava extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Javascript(), new Java());
    }
}
