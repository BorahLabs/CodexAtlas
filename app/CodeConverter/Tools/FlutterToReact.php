<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Flutter;
use App\Atlas\Frameworks\React;

class FlutterToReact extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Flutter(), new React());
    }
}
