<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Django;
use App\Atlas\Frameworks\Laravel;

class DjangoToLaravel extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Django(), new Laravel());
    }
}
