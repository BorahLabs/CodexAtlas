<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\PHP;
use App\Atlas\Languages\Ruby;

class PHPToRuby extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Ruby());
    }
}
