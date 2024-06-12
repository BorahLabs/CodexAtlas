<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Angular;
use App\Atlas\Frameworks\Flutter;

class FlutterToAngular extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Flutter(), new Angular());
    }
}
