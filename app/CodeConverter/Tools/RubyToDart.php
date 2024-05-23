<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Ruby;
use App\Atlas\Languages\Dart;

class RubyToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new Dart());
    }
}
