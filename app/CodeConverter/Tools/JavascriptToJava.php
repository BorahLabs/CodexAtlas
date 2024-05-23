<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Javascript;
use App\Atlas\Languages\Java;

class JavascriptToJava extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Javascript(), new Java());
    }
}
