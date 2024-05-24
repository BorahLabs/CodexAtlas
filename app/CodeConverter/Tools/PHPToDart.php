<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Dart;
use App\Atlas\Languages\PHP;

class PHPToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Dart());
    }
}
