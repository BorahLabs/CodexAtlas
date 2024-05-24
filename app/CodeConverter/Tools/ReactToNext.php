<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\React;
use App\Atlas\Frameworks\Next;

class ReactToNext extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new React(), new Next());
    }
}
