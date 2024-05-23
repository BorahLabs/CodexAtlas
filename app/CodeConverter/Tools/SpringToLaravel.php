<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Spring;
use App\Atlas\Frameworks\Laravel;

class SpringToLaravel extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Spring(), new Laravel());
    }
}
