<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Spring;
use App\Atlas\Languages\Dart;

class SpringToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Spring(), new Dart());
    }
}
