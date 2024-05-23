<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\DotNet;
use App\Atlas\Languages\Node;

class DotNetToNode extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new DotNet(), new Node());
    }
}
