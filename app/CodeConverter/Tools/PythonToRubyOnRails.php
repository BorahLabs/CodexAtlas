<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Python;
use App\Atlas\Frameworks\RubyOnRails;

class PythonToRubyOnRails extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Python(), new RubyOnRails());
    }
}
