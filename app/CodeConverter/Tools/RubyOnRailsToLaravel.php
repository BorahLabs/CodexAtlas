<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\RubyOnRails;
use App\Atlas\Frameworks\Laravel;

class RubyOnRailsToLaravel extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new RubyOnRails(), new Laravel());
    }
}
