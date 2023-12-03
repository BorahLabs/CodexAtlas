<?php

return [
    'dev' => [
        'local_folder' => env('LOCAL_FOLDER', '/Users/raullg/GitHub'),
        'repositories' => collect(explode(',', env('LOCAL_REPOSITORIES', '')))
            ->map(fn (string $item) => explode(':', $item)[0])
            ->toArray(),
        'projects' => collect(explode(',', env('LOCAL_REPOSITORIES', '')))
            ->mapWithKeys(fn (string $item) => str_contains($item, ':')
                ? [explode(':', $item)[0] => explode(':', $item)[1]]
                : [$item => $item]
            )
            ->toArray(),
    ],
];
