<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\PHP;
use App\Atlas\Languages\Rust;

class RustToPHP extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Rust(), new PHP());
    }
}
