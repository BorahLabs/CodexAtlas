<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Nuxt;
use App\Atlas\Frameworks\Next;

class NuxtToNext extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Nuxt(), new Next());
    }
}
