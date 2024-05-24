<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Dart;
use App\Atlas\Languages\Java;

class JavaToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Java(), new Dart());
    }
}
