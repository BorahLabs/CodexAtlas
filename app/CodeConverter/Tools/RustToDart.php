<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Dart;
use App\Atlas\Languages\Rust;

class RustToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Rust(), new Dart());
    }
}
