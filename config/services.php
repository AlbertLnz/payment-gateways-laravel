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

    'izipay' => [
        'url' => env('IZIPAY_URL'),
        'client_id' => env('IZIPAY_CLIENT_ID'),
        'client_secret' => env('IZIPAY_CLIENT_SECRET'),
        'public_key' => env('IZIPAY_PUBLIC_KEY'),
        'hash_key' => env('IZIPAY_HASH_KEY')
    ],

    'niubiz' => [
        'merchant_id' => env('NIUBIZ_MERCHANT_ID'),
        'currency' => env('NIUBIZ_CURRENCY'),
        'user' => env('NIUBIZ_USER'),
        'password' => env('NIUBIZ_PASSWORD'),
        'url_api' => env('NIUBIZ_URL_API'),
        'url_js' => env('NIUBIZ_URL_JS'),
    ],

    'paypal' => [
        'url' => env('PAYPAL_URL'),
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'secret' => env('PAYPAL_SECRET'),
    ],

    'payu' => [
        'merchant_id' => env('PAYU_MERCHANT_ID'),
        'account_id' => env('PAYU_ACCOUNT_ID'),
        'api_key' => env('PAYU_API_KEY'),
    ]

];
