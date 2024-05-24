<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Django;
use App\Atlas\Languages\Python;

class PythonToDjango extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new Django());
    }
}
