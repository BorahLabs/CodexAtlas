<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Javascript;
use App\Atlas\Frameworks\Laravel;

class JavascriptToLaravel extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Javascript(), new Laravel());
    }
}
