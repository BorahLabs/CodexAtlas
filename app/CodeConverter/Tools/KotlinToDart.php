<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Kotlin;
use App\Atlas\Languages\Dart;

class KotlinToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Kotlin(), new Dart());
    }
}
