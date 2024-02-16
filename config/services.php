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

    'google' => [
        /*'client_id' => '51521753806-igfc2e1cmvl4mcm869q3ovdohhvgn43i.apps.googleusercontent.com',
        'client_secret' => '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',*/
        'client_id' => '67125813844-j1ap4cud0lc4f2f8aobp573qebam799a.apps.googleusercontent.com',
        'client_secret' => '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',

        'redirect' => 'https://www.top100filmes.com.br/callback/google',
    ],

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

];
