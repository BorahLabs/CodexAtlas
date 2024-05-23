<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Languages\Swift;

class LaravelToSwift extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Laravel(), new Swift());
    }
}
