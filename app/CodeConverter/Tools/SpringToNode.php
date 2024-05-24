<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Spring;
use App\Atlas\Languages\Node;

class SpringToNode extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Spring(), new Node());
    }
}
