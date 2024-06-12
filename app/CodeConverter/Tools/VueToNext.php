<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Next;
use App\Atlas\Frameworks\Vue;

class VueToNext extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Vue(), new Next());
    }
}
