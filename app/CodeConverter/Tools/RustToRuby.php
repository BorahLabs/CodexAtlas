<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Rust;
use App\Atlas\Languages\Ruby;

class RustToRuby extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Rust(), new Ruby());
    }
}
