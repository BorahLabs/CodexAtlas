<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Nuxt;
use App\Atlas\Languages\DotNet;

class NuxtToDotNet extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Nuxt(), new DotNet());
    }
}
