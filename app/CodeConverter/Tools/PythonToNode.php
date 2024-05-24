<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Node;
use App\Atlas\Languages\Python;

class PythonToNode extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Node());
    }
}
