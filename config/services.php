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
        'gh_app_redirect_url' => env('GITHUB_APP_REDIRECT_URL', 'https://github.com/apps/codexatlas/installations/select_target')
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
        'completion_model' => env('OPENAI_COMPLETION_MODEL', 'gpt-3.5-turbo-0125'),
        'embeddings_model' => env('OPENAI_EMBEDDINGS_MODEL', 'text-embedding-ada-002'),
    ],

    'cloudflare' => [
        'turnstile' => [
            'site_key' => env('TURNSTILE_SITE_KEY'),
            'secret_key' => env('TURNSTILE_SECRET_KEY'),
        ],
    'ngrok' => [
        'active_helper' => false, // put it to true if you are using ngrok and  ALWAYS SHOULD BE FALSE
        'user_id' => '9b22f325-516a-48b2-8ffa-9d724a08267c', //userId to automatically login
        'ngrok_domain' => 'https://cff9-88-25-31-8.ngrok-free.app' //ngrok url
    ],

    'gh' => [
        'api_endpoint' => env('GITHUB_API_ENDPOINT'),
    ],

    'openAI' => [
        'api_endpoint' => env('OPENAI_API_ENDPOINT'),
        'token' => env('OPENAI_API_TOKEN')
    ]

];
