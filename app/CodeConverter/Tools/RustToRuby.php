<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Ruby;
use App\Atlas\Languages\Rust;

class RustToRuby extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Rust(), new Ruby());
    }
}
