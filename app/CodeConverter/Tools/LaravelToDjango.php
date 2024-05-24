<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Django;
use App\Atlas\Frameworks\Laravel;

class LaravelToDjango extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Laravel(), new Django());
    }
}
