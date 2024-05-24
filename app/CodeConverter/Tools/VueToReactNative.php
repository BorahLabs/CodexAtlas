<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\ReactNative;
use App\Atlas\Frameworks\Vue;

class VueToReactNative extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Vue(), new ReactNative());
    }
}
