<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Node;
use App\Atlas\Languages\Swift;

class NodeToSwift extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new Swift());
    }
}
