<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Node;
use App\Atlas\Frameworks\Spring;

class NodeToSpring extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new Spring());
    }
}
