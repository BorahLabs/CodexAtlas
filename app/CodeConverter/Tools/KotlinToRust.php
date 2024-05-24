<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Kotlin;
use App\Atlas\Languages\Rust;

class KotlinToRust extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Kotlin(), new Rust());
    }
}
