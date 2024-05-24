<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\IonicAngular;
use App\Atlas\Frameworks\Flutter;

class IonicAngularToFlutter extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new IonicAngular(), new Flutter());
    }
}
