<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Java;
use App\Atlas\Languages\Swift;

class SwiftToJava extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Swift(), new Java());
    }
}
