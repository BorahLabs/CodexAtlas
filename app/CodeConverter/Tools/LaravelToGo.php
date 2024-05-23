<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Languages\Go;

class LaravelToGo extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Laravel(), new Go());
    }
}
