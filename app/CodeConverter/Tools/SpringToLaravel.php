<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Frameworks\Spring;

class SpringToLaravel extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Spring(), new Laravel());
    }
}
