<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\PHP;
use App\Atlas\Frameworks\Next;

class PHPToNext extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Next());
    }
}
