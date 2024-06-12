<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Dart;
use App\Atlas\Languages\Python;

class PythonToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Dart());
    }
}
