<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Next;
use App\Atlas\Languages\Go;

class NextToGo extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Next(), new Go());
    }
}
