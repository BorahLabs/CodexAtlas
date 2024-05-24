<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Flutter;
use App\Atlas\Frameworks\IonicAngular;

class FlutterToIonicAngular extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Flutter(), new IonicAngular());
    }
}
