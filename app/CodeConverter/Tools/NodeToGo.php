<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Go;
use App\Atlas\Languages\Node;

class NodeToGo extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new Go());
    }
}
