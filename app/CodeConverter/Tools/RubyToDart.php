<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Dart;
use App\Atlas\Languages\Ruby;

class RubyToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new Dart());
    }
}
