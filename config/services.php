<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],


    'github' => [
        'client_id' => '89caf749593dfff33916',
        'client_secret' => '87b0d3e4c55f4a05a9987b8417c9b7f15d9f5de9',
        'redirect' => 'http://webcasts.dev/login/socialite/github/callback',
    ],

    'linkedin' => [
        'client_id' => '77q87ypi3owvzc',
        'client_secret' => 'iqLfIDszLThhcwau',
        'redirect' => 'http://webcasts.dev/login/socialite/linkedin/callback',
    ],

    'facebook' => [
        'client_id' => '124426351251441',
        'client_secret' => '6e9738e40662c7866087204da4653e85',
        'redirect' => 'http://webcasts.dev/login/socialite/facebook/callback',
    ],

];
