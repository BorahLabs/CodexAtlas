<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Node;
use App\Atlas\Frameworks\Laravel;

class NodeToLaravel extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new Laravel());
    }
}
