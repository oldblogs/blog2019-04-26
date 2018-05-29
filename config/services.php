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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', null),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', null),
        'auth_endpoint' => env('FACEBOOK_AUTH_ENDPOINT', '/slogin/facebook'),
        'token_exchange_endpoint' => env('FACEBOOK_TOKEN_EXCHANGE_ENDPOINT','/slogin/facebook/callback'),
        'redirect' => env('APP_URL').env('FACEBOOK_TOKEN_EXCHANGE_ENDPOINT','/slogin/facebook/callback'),
    ],
    
    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID', null),
        'client_secret' => env('TWITTER_CLIENT_SECRET', null),
        'auth_endpoint' => env('TWITTER_AUTH_ENDPOINT', '/slogin/twitter'),
        'token_exchange_endpoint' => env('TWITTER_TOKEN_EXCHANGE_ENDPOINT','/slogin/twitter/callback'),
        'redirect' => env('APP_URL').env('TWITTER_TOKEN_EXCHANGE_ENDPOINT','/slogin/twitter/callback'),
    ],
    
    'linkedin' => [
        'client_id' => env('LINKEDIN_CLIENT_ID', null),
        'client_secret' => env('LINKEDIN_CLIENT_SECRET', null),
        'auth_endpoint' => env('LINKEDIN_AUTH_ENDPOINT', '/slogin/linkedin'),
        'token_exchange_endpoint' => env('LINKEDIN_TOKEN_EXCHANGE_ENDPOINT','/slogin/linkedin/callback'),
        'redirect' => env('APP_URL').env('LINKEDIN_TOKEN_EXCHANGE_ENDPOINT','/slogin/linkedin/callback'),
    ],
    
    'google' => [
       'client_id' => env('GOOGLE_CLIENT_ID', null),
       'client_secret' => env('GOOGLE_CLIENT_SECRET', null),
       'auth_endpoint' => env('GOOGLE_AUTH_ENDPOINT', '/slogin/google'),
       'token_exchange_endpoint' => env('GOOGLE_TOKEN_EXCHANGE_ENDPOINT','/slogin/google/callback'),
       'redirect' => env('APP_URL').env('GOOGLE_TOKEN_EXCHANGE_ENDPOINT','/slogin/google/callback'),
    ],
    
    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID', null),
        'client_secret' => env('GITHUB_CLIENT_SECRET', null),
        'auth_endpoint' => env('GITHUB_AUTH_ENDPOINT', '/slogin/github'),
        'token_exchange_endpoint' => env('GITHUB_TOKEN_EXCHANGE_ENDPOINT','/slogin/github/callback'),
        'redirect' => env('APP_URL').env('GITHUB_TOKEN_EXCHANGE_ENDPOINT','/slogin/github/callback'),
    ],
    
    'bitbucket' => [
        'client_id' => env('BITBUCKET_CLIENT_ID', null),
        'client_secret' => env('BITBUCKET_CLIENT_SECRET', null),
        'auth_endpoint' => env('BITBUCKET_AUTH_ENDPOINT', '/slogin/bitbucket'),
        'token_exchange_endpoint' => env('BITBUCKET_TOKEN_EXCHANGE_ENDPOINT','/slogin/bitbucket/callback'),
        'redirect' => env('APP_URL').env('BITBUCKET_TOKEN_EXCHANGE_ENDPOINT','/slogin/bitbucket/callback'),
    ],
    
];
