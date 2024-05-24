<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Go;
use App\Atlas\Languages\Javascript;

class JavascriptToGo extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Javascript(), new Go());
    }
}
