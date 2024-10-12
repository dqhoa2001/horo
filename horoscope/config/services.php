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
    
    // stripeのAPIキーを設定
    'stripe' => [
        'public' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    // 製本直送のキーを設定
    'seichoku' => [
        'customer_id' => env('SEICHOKU_CUSTOMER_ID'),
        'access_key' => env('SEICHOKU_ACCESS_KEY'),
        'secret_key' => env('SEICHOKU_SECRET_KEY'),
        'ftp_dir' => env('SEICHOKU_FTP_DIR'),
        'api_ftp_dir' => env('SEICHOKU_API_FTP_DIR'),
    ],

];
