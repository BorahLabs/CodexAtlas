<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\DotNet;
use App\Atlas\Languages\Ruby;

class DotNetToRuby extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new DotNet(), new Ruby());
    }
}
