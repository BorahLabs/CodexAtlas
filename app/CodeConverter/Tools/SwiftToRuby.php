<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Ruby;
use App\Atlas\Languages\Swift;

class SwiftToRuby extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Swift(), new Ruby());
    }
}
