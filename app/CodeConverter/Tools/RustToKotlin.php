<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Kotlin;
use App\Atlas\Languages\Rust;

class RustToKotlin extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Rust(), new Kotlin());
    }
}
