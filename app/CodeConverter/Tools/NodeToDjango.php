<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Django;
use App\Atlas\Languages\Node;

class NodeToDjango extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new Django());
    }
}
