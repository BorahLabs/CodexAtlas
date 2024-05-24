<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Django;
use App\Atlas\Frameworks\RubyOnRails;

class RubyOnRailsToDjango extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new RubyOnRails(), new Django());
    }
}
