<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\DotNet;
use App\Atlas\Languages\Ruby;

class RubyToDotNet extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new DotNet());
    }
}
