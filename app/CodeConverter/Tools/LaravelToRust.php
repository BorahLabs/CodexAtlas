<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Languages\Rust;

class LaravelToRust extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Laravel(), new Rust());
    }
}
