<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Languages\Python;

class PythonToLaravel extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Laravel());
    }
}
