<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Java;
use App\Atlas\Languages\DotNet;

class JavaToDotNet extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Java(), new DotNet());
    }
}
