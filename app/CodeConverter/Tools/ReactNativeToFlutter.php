<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Flutter;
use App\Atlas\Frameworks\ReactNative;

class ReactNativeToFlutter extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new ReactNative(), new Flutter());
    }
}
