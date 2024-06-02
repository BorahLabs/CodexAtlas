<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;
use App\Atlas\Guesser;

class FrameworkFactory
{
    public static function get(string $frameworkName): ?Framework
    {

        return collect(Guesser::supportedFrameworks())->first(function (Framework $framework) use ($frameworkName) {
            return $framework->name() === $frameworkName;
        });
    }
}
