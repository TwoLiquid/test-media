<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Api General Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error
    | messages used by the validator class
    |
    */

    'content' => [
        'required' => 'The content field is required.',
        'string'   => 'The content field must be a string.'
    ],
    'mime' => [
        'required' => 'The mime field is required.',
        'string'   => 'The mime field must be a string.'
    ],
    'extension' => [
        'required' => 'The extension field is required.',
        'string'   => 'The extension field must be a string.'
    ],
    'result' => [
        'error'   => 'Failed to create а review message image.',
        'success' => 'Review message image has been successfully stored.'
    ]
];
