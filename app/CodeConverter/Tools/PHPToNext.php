<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Next;
use App\Atlas\Languages\PHP;

class PHPToNext extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Next());
    }
}
