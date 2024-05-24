<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Django;
use App\Atlas\Frameworks\Spring;

class DjangoToSpring extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Django(), new Spring());
    }
}
