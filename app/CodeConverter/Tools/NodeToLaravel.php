<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Languages\Node;

class NodeToLaravel extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new Laravel());
    }
}
