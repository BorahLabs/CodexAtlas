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
    'forbidden_subdomains' => [
        'knowledge-base',
    ],
    'atlas' => [
        'allowed_extensions' => array_flip([
            'php',
            'js',
            'ts',
            'vue',
            'html',
            'css',
            'scss',
            'md',
            'json',
            'yml',
            'yaml',
            'xml',
            'blade.php',
            'twig',
            'java',
            'py',
            'go',
            'rb',
            'cs',
            'c',
            'cpp',
            'h',
            'hpp',
            'rs',
            'sh',
            'sql',
            'swift',
            'kt',
            'ktm',
            'kts',
            'cbl',
            'cob',
            'cpy',
            'txt',
            'ini',
            'jsx',
            'tsx',
            'less',
            'sass',
            'dart',
            'rb',
            'erb',
        ]),
    ],
    'payment_mode' => env('PAYMENT_MODE', 'spark'),
    'pay_as_you_go' => false,
    'aws_marketplace_link' => env('AWS_MARKETPLACE_URL', '#'),
    'support_email' => env('SUPPORT_EMAIL', 'support@codexatlas.app'),
];
