<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Rust;
use App\Atlas\Languages\Javascript;

class RustToJavascript extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Rust(), new Javascript());
    }
}
