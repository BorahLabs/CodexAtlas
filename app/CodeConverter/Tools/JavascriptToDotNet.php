<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\DotNet;
use App\Atlas\Languages\Javascript;

class JavascriptToDotNet extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Javascript(), new DotNet());
    }
}
