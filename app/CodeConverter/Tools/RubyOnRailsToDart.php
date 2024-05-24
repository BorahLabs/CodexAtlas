<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\RubyOnRails;
use App\Atlas\Languages\Dart;

class RubyOnRailsToDart extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new RubyOnRails(), new Dart());
    }
}
