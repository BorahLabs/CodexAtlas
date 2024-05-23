<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Nuxt;
use App\Atlas\Languages\Go;

class NuxtToGo extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Nuxt(), new Go());
    }
}
