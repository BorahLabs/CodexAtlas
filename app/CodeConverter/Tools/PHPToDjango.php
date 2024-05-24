<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Django;
use App\Atlas\Languages\PHP;

class PHPToDjango extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new Django());
    }
}
