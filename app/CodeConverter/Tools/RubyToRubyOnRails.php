<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Ruby;
use App\Atlas\Frameworks\RubyOnRails;

class RubyToRubyOnRails extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Ruby(), new RubyOnRails());
    }
}
