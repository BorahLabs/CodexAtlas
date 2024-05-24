<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Dart;
use App\Atlas\Languages\DotNet;

class DotNetToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new DotNet(), new Dart());
    }
}
