<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Nuxt;
use App\Atlas\Frameworks\Vue;

class VueToNuxt extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Vue(), new Nuxt());
    }
}
