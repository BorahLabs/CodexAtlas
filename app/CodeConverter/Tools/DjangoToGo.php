<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Django;
use App\Atlas\Languages\Go;

class DjangoToGo extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Django(), new Go());
    }
}
