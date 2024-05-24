<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\RubyOnRails;
use App\Atlas\Languages\Rust;

class RubyOnRailsToRust extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new RubyOnRails(), new Rust());
    }
}
