<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Spring;
use App\Atlas\Languages\DotNet;

class SpringToDotNet extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Spring(), new DotNet());
    }
}
