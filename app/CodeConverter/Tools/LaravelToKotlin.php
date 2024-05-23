<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Languages\Kotlin;

class LaravelToKotlin extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Laravel(), new Kotlin());
    }
}
