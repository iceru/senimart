<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'google' => [
        'client_id'     => env('247115383792-g0hq0m5acfv5gdekqoj43cngoh6v8s73.apps.googleusercontent.com'),
        'client_secret' => env('pktKm89FEEjJozMkJyNOYXFN'),
        'redirect'      => env('http://localhost:8000/callback')
    ],

    'midtrans' => [
        // Midtrans server key
        'serverKey'     => env('SB-Mid-server-dIJfDGxXkYO5EvS9m5px575p'),
        // Midtrans client key
        'clientKey'     => env('SB-Mid-client-6TjTY3gEDbKoKqVy'),
        // Isi false jika masih tahap development dan true jika sudah di production, default false (development)
        'isProduction'  => env('MIDTRANS_IS_PRODUCTION', false),
        'isSanitized'   => env('MIDTRANS_IS_SANITIZED', true),
        'is3ds'         => env('MIDTRANS_IS_3DS', true),                
    ],

];