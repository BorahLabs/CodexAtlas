<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Angular;
use App\Atlas\Frameworks\React;

class AngularToReact extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Angular(), new React());
    }
}
