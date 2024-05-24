<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Node;
use App\Atlas\Frameworks\RubyOnRails;

class NodeToRubyOnRails extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Node(), new RubyOnRails());
    }
}
