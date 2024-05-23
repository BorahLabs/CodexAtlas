<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Vue;
use App\Atlas\Frameworks\Nuxt;

class VueToNuxt extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Vue(), new Nuxt());
    }
}
