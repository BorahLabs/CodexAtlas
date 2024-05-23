<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Node;
use App\Atlas\Languages\Kotlin;

class NodeToKotlin extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new Kotlin());
    }
}
