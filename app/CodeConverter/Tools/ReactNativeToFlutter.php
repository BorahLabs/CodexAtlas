<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\ReactNative;
use App\Atlas\Frameworks\Flutter;

class ReactNativeToFlutter extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new ReactNative(), new Flutter());
    }
}
