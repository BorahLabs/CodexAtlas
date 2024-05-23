<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Java;
use App\Atlas\Languages\Rust;

class JavaToRust extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Java(), new Rust());
    }
}
