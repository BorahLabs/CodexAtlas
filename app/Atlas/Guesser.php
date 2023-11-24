<?php

namespace App\Atlas;

use App\Atlas\Frameworks\Contracts\Framework;
use App\Exceptions\CouldNotDetectFramework;
use App\SourceCode\DTO\Folder;

class Guesser
{
    public static function make(): static
    {
        return new static();
    }

    public function guessFramework(Folder $folder): Framework
    {
        $frameworks = $this->supportedFrameworks();
        foreach ($frameworks as $framework) {
            if ($framework->usesFramework($folder)) {
                return $framework;
            }
        }

        throw new CouldNotDetectFramework();
    }

    /**
     * @return Framework[]
     */
    private function supportedFrameworks(): array
    {
        return [
            new Frameworks\Laravel(),
            new Frameworks\Spring(),
            new Frameworks\Django(),
            new Frameworks\IonicAngular(),
            new Frameworks\Next(),
            new Frameworks\Nuxt(),
            new Frameworks\ReactNative(),
            new Frameworks\Angular(),
            new Frameworks\Vue(),
            new Frameworks\React(),
        ];
    }
}
