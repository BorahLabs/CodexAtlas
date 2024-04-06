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

    'user_model' => \App\Models\User::class,
];
