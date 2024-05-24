<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\DotNet;
use App\Atlas\Languages\Node;

class NodeToDotNet extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new DotNet());
    }
}
