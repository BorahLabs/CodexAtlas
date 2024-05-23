<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Languages\Dart;

class LaravelToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Laravel(), new Dart());
    }
}
