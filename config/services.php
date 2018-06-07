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

    'twitter' => [
      'client_id' => 'UJqIh5VecJ5M5MOD934PviCKE',
      'client_secret' => 'loZS2oHYovNTI6u2o1I69MXbPRdq8Rpl8ZXJxw1Fv7HP89qC12',
      'redirect' => 'http://localhost/konterPulsa/public/auth/twitter/callback',
   ],

   'github' => [
      'client_id' => 'd020f42699ccab59b77a',
      'client_secret' => '119260497d87ffccf90584d17252294bc7d0a5af',
      'redirect' => 'http://localhost/konterPulsa/public/auth/github/callback',
   ],

   'facebook' => [
      'client_id' => '426392807824447',
      'client_secret' => '6ebabd98b59efda417a2e72aeb764374',
      'redirect' => 'http://localhost/konterPulsa/public/auth/facebook/callback',
   ],

   'google' => [
      'client_id' => '271063747371-2brtviok0ohqpi9nk8qkf29mfmpuutmm.apps.googleusercontent.com',
      'client_secret' => 'BYw5e5hWZnfH14G2KQi8ikzo',
      'redirect' => 'http://localhost/konterPulsa/public/auth/google/callback',
   ],

];
