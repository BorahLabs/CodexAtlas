<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\PHP;
use App\Atlas\Frameworks\Laravel;

class PHPToLaravel extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Laravel());
    }
}
