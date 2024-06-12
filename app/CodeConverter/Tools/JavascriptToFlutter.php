<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Frameworks\Flutter;
use App\Atlas\Languages\Javascript;

class JavascriptToFlutter extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Javascript(), new Flutter());
    }
}
