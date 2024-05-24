<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Dart;
use App\Atlas\Languages\Kotlin;

class KotlinToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Kotlin(), new Dart());
    }
}
