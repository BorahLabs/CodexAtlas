<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Node;
use App\Atlas\Languages\Ruby;

class NodeToRuby extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new Ruby());
    }
}
