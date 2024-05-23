<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Spring;
use App\Atlas\Languages\Go;

class SpringToGo extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Spring(), new Go());
    }
}
