<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Next;
use App\Atlas\Languages\DotNet;

class NextToDotNet extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Next(), new DotNet());
    }
}
