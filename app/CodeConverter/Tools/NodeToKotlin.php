<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Kotlin;
use App\Atlas\Languages\Node;

class NodeToKotlin extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new Kotlin());
    }
}
