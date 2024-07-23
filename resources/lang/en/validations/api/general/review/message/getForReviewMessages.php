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

    'review_messages_ids' => [
        'required' => 'The review messages ids field is required.',
        'array'    => 'The review messages ids field must be an array.',
        '*' => [
            'required' => 'The review message id field is required.',
            'string'   => 'The review message id field must be a string.'
        ]
    ],
    'auth_ids' => [
        'required' => 'The auth ids field is required.',
        'array'    => 'The auth ids field must be an array.',
        '*' => [
            'required' => 'The auth id field is required.',
            'integer'  => 'The auth id field must be a integer.'
        ]
    ],
    'result' => [
        'success' => 'Review messages media has been successfully received.'
    ]
];
