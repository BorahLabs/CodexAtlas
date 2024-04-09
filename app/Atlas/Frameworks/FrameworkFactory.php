<?php

namespace App\Atlas\Frameworks;

use App\Atlas\Frameworks\Contracts\Framework;   

class FrameworkFactory
{
    public static function get(string $frameworkName): ?Framework
    {
        return match ($frameworkName) {
            'Laravel' => new Laravel(),
            'Angular' => new Angular(),
            'Django' => new Django(),
            'Flutter' => new Flutter(),
            'Default' => new GeneralFramework(),
            'Ionic + Angular' => new IonicAngular(),
            'Next' => new Next(),
            'NuxtJS' => new Nuxt(),
            'React' => new React(),
            'React Native' => new ReactNative(),
            'Ruby on Rails' => new RubyOnRails(),
            'Spring' => new Spring(),
            'Vue' => new Vue(),
            default => null
        };
    }
}
