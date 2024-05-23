<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Kotlin;
use App\Atlas\Languages\Swift;

class KotlinToSwift extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Kotlin(), new Swift());
    }
}
