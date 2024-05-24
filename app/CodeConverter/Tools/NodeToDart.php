<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Dart;
use App\Atlas\Languages\Node;

class NodeToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new Dart());
    }
}
