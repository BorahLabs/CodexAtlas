<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Swift;
use App\Atlas\Languages\Ruby;

class SwiftToRuby extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Swift(), new Ruby());
    }
}
