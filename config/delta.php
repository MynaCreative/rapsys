<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Delta Configuration
    |--------------------------------------------------------------------------
    |
    | This option controls the default configuration to connect Delta App
    |
    */

    'rest' => [
        'url'       => env('DELTA_REST_URL', 'url.test'),
        'username'  => env('DELTA_REST_USERNAME', 'username'),
        'password'  => env('DELTA_REST_PASSWORD', 'password'),
    ],

    'soap' => [
        'url'       => env('DELTA_SOAP_URL', 'url.test'),
        'username'  => env('DELTA_SOAP_USERNAME', 'username'),
        'password'  => env('DELTA_SOAP_PASSWORD', 'password'),
    ],

];
