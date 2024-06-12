<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Languages\PHP;

class PHPToLaravel extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Laravel());
    }
}
