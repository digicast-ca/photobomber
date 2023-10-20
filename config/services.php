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

    'digi_compiler' => [
        'min_album_photo_count' => env('DC_MIN_ALBUM_PHOTO_COUNT', 6),
        'max_album_photo_count' => env('DC_MAX_ALBUM_PHOTO_COUNT', 30),
        'chance_of_low_photobombing_levels_exception' => env('DC_CHANCE_OF_LOW_PHOTOBOMBING_LEVELS_EXCEPTION', 25),
        'delay_multiplier' => env('DC_DELAY_MULTIPLIER', 3),
    ],

];
