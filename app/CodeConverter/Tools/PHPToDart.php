<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\PHP;
use App\Atlas\Languages\Dart;

class PHPToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Dart());
    }
}
