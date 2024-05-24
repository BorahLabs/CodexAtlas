<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\DotNet;
use App\Atlas\Languages\Kotlin;

class DotNetToKotlin extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new DotNet(), new Kotlin());
    }
}
