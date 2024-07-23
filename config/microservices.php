<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Microservices Config Parameters
    |--------------------------------------------------------------------------
    |
    | Each microservice contains own parameters
    |
    */

    'auth' => [
        'url' => env('AUTH_SERVICE_URL'),
        'key' => env('AUTH_SERVICE_KEY')
    ]
];
