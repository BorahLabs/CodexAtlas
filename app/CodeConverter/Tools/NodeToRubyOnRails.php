<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\RubyOnRails;
use App\Atlas\Languages\Node;

class NodeToRubyOnRails extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new RubyOnRails());
    }
}
