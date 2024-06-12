<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Python;
use App\Atlas\Languages\Rust;

class RustToPython extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Rust(), new Python());
    }
}
