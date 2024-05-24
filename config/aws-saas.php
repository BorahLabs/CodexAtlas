<?php

return [
    'credentials' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'product' => [
        'code' => env('AWS_MARKETPLACE_PRODUCT_CODE'),
    ],

    'local' => [
        'token' => env('AWS_MARKETPLACE_LOCAL_TOKEN'),
    ],

    'layouts' => [
        'new-user' => 'app-layout',
    ],

    'components' => [
        'button' => [
            'name' => 'button',
            'attributes' => ['theme' => 'primary'],
        ],
    ],

    'routes' => [
        'register' => 'register',
        'login' => 'login',
        'logout' => 'logout',
    ],

    'verify_csrf_middleware' => class_exists(\App\Http\Middleware\VerifyCsrfToken::class) ? \App\Http\Middleware\VerifyCsrfToken::class : null,
    'user_model' => class_exists(\App\Models\User::class) ? \App\Models\User::class : null,
];
