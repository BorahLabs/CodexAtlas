<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Languages\DotNet;

class LaravelToDotNet extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Laravel(), new DotNet());
    }
}
