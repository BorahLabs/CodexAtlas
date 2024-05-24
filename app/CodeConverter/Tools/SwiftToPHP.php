<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\PHP;
use App\Atlas\Languages\Swift;

class SwiftToPHP extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Swift(), new PHP());
    }
}
