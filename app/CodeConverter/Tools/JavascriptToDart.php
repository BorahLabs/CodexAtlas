<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Dart;
use App\Atlas\Languages\Javascript;

class JavascriptToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Javascript(), new Dart());
    }
}
