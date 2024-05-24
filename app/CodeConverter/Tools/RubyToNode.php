<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Node;
use App\Atlas\Languages\Ruby;

class RubyToNode extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new Node());
    }
}
