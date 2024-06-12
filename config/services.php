<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => env('GITHUB_CALLBACK_URL'),
    ],

    'gitlab' => [
        'client_id' => env('GITLAB_CLIENT_ID'),
        'client_secret' => env('GITLAB_CLIENT_SECRET'),
        'redirect' => env('GITLAB_REDIRECT_URI'),
    ],

    'bitbucket' => [
        'client_id' => env('BITBUCKET_CLIENT_ID'),
        'client_secret' => env('BITBUCKET_CLIENT_SECRET'),
        'redirect' => env('BITBUCKET_REDIRECT_URI'),
    ],

    'openai' => [
        'key' => env('OPENAI_API_KEY'),
        'completion_model' => env('OPENAI_COMPLETION_MODEL', 'gpt-4o'),
        'embeddings_model' => env('OPENAI_EMBEDDINGS_MODEL', 'text-embedding-ada-002'),
    ],

    'cloudflare' => [
        'turnstile' => [
            'site_key' => env('TURNSTILE_SITE_KEY'),
            'secret_key' => env('TURNSTILE_SECRET_KEY'),
        ],
    ],

    'modal' => [
        'codex' => [
            'describe_file_endpoint' => env('MODAL_CODEX_DESCRIBE_FILE_ENDPOINT'),
        ],
    ],

    'lmstudio' => [
        'url' => env('LMSTUDIO_URL', 'http://localhost:1234/v1'),
        'completion_model' => env('LMSTUDIO_COMPLETION_MODEL', 'TheBloke/phi-2-GGUF'),
    ],

    'readme_generator' => [
        'endpoint' => [
            'offline' => env('README_GENERATOR_OFFLINE_ENDPOINT', 'https://readme-generator.codexatlas.app/v1/offline'),
        ],
    ],

    'convertkit' => [
        'key' => env('CONVERTKIT_API_KEY'),
        'secret' => env('CONVERTKIT_API_SECRET'),
        'sequences' => [
            'welcome' => env('CONVERTKIT_SEQUENCE_WELCOME', 1927528),
        ],
        'tags' => [
            'onboarding' => env('CONVERTKIT_TAG_ONBOARDING', 5072030),
        ],
    ],
];
