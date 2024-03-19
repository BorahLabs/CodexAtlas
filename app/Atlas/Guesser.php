<?php

namespace App\Atlas;

use App\Atlas\Frameworks\Contracts\Framework;
use App\Atlas\Languages\Contracts\Language;
use App\Exceptions\CouldNotDetectLanguage;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

class Guesser
{
    public static function make(): static
    {
        return new static();
    }

    public function guessFramework(Folder $folder): Framework
    {
        $frameworks = static::supportedFrameworks();
        foreach ($frameworks as $framework) {
            if ($framework->usesFramework($folder)) {
                return $framework;
            }
        }
    }

    /**
     * @return Framework[]
     */
    public static function supportedFrameworks(): array
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
            new Frameworks\Flutter(),
            new Frameworks\RubyOnRails(),
            new Frameworks\Flask(),
            new Frameworks\Symfony(),
            new Frameworks\GeneralFramework(),
        ];
    }

    public function guessLanguage(File $file): Language
    {
        $languages = static::supportedLanguages();
        foreach ($languages as $language) {
            if ($language->isOwnFile($file)) {
                return $language;
            }
        }

        throw new CouldNotDetectLanguage();
    }

    /**
     * @return Language[]
     */
    public static function supportedLanguages(): array
    {
        return [
            new Languages\Cobol(),
            new Languages\Css(),
            new Languages\DotNet(),
            new Languages\Go(),
            new Languages\Html(),
            new Languages\Java(),
            new Languages\Javascript(),
            new Languages\Kotlin(),
            new Languages\Node(),
            new Languages\PHP(),
            new Languages\Python(),
            new Languages\Rust(),
            new Languages\Swift(),
            new Languages\Dart(),
            new Languages\Ruby(),
        ];
    }
}
