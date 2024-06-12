<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\PHP;
use App\Atlas\Languages\Ruby;

class RubyToPHP extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new PHP());
    }
}
