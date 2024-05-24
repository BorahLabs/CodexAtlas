<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Rust;
use App\Atlas\Languages\PHP;

class RustToPHP extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Rust(), new PHP());
    }
}
