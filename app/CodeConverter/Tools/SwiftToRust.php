<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Swift;
use App\Atlas\Languages\Rust;

class SwiftToRust extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Swift(), new Rust());
    }
}
