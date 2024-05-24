<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Django;
use App\Atlas\Languages\Kotlin;

class DjangoToKotlin extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Django(), new Kotlin());
    }
}
