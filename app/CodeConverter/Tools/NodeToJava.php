<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Java;
use App\Atlas\Languages\Node;

class NodeToJava extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new Java());
    }
}
