<?php

return [
    'stripe' => [
        'key' => env('AUTODOC_STRIPE_KEY') ?? env('STRIPE_KEY'),
        'secret' => env('AUTODOC_STRIPE_SECRET') ?? env('STRIPE_SECRET'),
        'webhook_secret' => env('AUTODOC_STRIPE_WEBHOOK_SECRET') ?? env('STRIPE_WEBHOOK_SECRET'),
    ],
    'project_id' => env('AUTODOC_PROJECT_ID'),
];
