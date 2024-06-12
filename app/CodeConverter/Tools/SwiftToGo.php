<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Go;
use App\Atlas\Languages\Swift;

class SwiftToGo extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Swift(), new Go());
    }
}
