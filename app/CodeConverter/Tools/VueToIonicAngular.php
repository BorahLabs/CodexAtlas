<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Vue;
use App\Atlas\Frameworks\IonicAngular;

class VueToIonicAngular extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Vue(), new IonicAngular());
    }
}
