<?php

namespace App\CodeConverter\Tools;

use App\Atlas\Languages\Javascript;
use App\Atlas\Frameworks\Flutter;

class JavascriptToFlutter extends CodeConverterTool
{
    public function __construct()
    {
        parent::__construct(new Javascript(), new Flutter());
    }
}
