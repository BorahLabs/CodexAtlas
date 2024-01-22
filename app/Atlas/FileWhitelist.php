<?php

namespace App\Atlas;

class FileWhitelist
{
    public static function whitelisted(string $path): bool
    {
        // ignore the folders where dependencies are installed
        if (str($path)->contains([
            'node_modules/',
            'vendor/',
            'Pods/',
            'Carthage/',
            'build/',
            'dist/',
            'out/',
            'target/',
            'bin/',
            '__pycache__/',
        ])) {
            return false;
        }

        $extension = mb_strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return isset(config('codex.atlas.allowed_extensions')[$extension]);
    }
}
