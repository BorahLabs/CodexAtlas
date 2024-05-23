<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\ReactNative;
use App\Atlas\Frameworks\IonicAngular;

class ReactNativeToIonicAngular extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new ReactNative(), new IonicAngular());
    }
}
