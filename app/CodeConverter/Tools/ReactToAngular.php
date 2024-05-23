<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\React;
use App\Atlas\Frameworks\Angular;

class ReactToAngular extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new React(), new Angular());
    }
}
