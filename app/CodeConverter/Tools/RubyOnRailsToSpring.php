<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\RubyOnRails;
use App\Atlas\Frameworks\Spring;

class RubyOnRailsToSpring extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new RubyOnRails(), new Spring());
    }
}
