<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Django;
use App\Atlas\Languages\PHP;

class DjangoToPHP extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Django(), new PHP());
    }
}
