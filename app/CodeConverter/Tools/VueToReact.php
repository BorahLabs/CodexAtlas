<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Vue;
use App\Atlas\Frameworks\React;

class VueToReact extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Vue(), new React());
    }
}
