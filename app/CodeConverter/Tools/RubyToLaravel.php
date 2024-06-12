<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Languages\Ruby;

class RubyToLaravel extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new Laravel());
    }
}
