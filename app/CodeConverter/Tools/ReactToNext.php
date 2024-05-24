<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Next;
use App\Atlas\Frameworks\React;

class ReactToNext extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new React(), new Next());
    }
}
