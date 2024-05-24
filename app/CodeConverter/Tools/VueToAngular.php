<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Angular;
use App\Atlas\Frameworks\Vue;

class VueToAngular extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Vue(), new Angular());
    }
}
