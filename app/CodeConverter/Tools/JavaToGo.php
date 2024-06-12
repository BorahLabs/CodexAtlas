<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Go;
use App\Atlas\Languages\Java;

class JavaToGo extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Java(), new Go());
    }
}
