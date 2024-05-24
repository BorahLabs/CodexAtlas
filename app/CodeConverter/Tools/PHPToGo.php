<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Go;
use App\Atlas\Languages\PHP;

class PHPToGo extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Go());
    }
}
