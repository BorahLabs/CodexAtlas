<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Frameworks\Spring;

class LaravelToSpring extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Laravel(), new Spring());
    }
}
