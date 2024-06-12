<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Next;
use App\Atlas\Frameworks\Spring;

class SpringToNext extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Spring(), new Next());
    }
}
