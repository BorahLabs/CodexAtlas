<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Kotlin;
use App\Atlas\Languages\Node;

class KotlinToNode extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Kotlin(), new Node());
    }
}
