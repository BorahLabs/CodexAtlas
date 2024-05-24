<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Angular;
use App\Atlas\Frameworks\ReactNative;

class AngularToReactNative extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Angular(), new ReactNative());
    }
}
