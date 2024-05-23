<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Ruby;
use App\Atlas\Frameworks\Django;

class RubyToDjango extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new Django());
    }
}
