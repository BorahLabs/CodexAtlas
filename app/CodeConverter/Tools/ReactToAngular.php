<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Angular;
use App\Atlas\Frameworks\React;

class ReactToAngular extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new React(), new Angular());
    }
}
