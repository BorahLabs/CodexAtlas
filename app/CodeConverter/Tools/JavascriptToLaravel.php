<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Laravel;
use App\Atlas\Languages\Javascript;

class JavascriptToLaravel extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Javascript(), new Laravel());
    }
}
