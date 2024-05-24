<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Django;
use App\Atlas\Languages\Ruby;

class RubyToDjango extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new Django());
    }
}
