<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\RubyOnRails;
use App\Atlas\Languages\PHP;

class PHPToRubyOnRails extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new PHP(), new RubyOnRails());
    }
}
