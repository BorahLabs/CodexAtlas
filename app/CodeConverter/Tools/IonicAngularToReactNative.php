<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\IonicAngular;
use App\Atlas\Frameworks\ReactNative;

class IonicAngularToReactNative extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new IonicAngular(), new ReactNative());
    }
}
