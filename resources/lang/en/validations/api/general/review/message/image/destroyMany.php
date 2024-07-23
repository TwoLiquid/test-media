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

    'review_message_images_ids' => [
        'required' => 'The review message images ids field is required.',
        'array'    => 'The review message images ids field must be an array.',
        '*' => [
            'required' => 'The review message image id field is required.',
            'string'   => 'The review message image id field must be a string.',
            'exists'   => 'The selected review message image id field is invalid.'
        ]
    ],
    'result' => [
        'error' => [
            'find' => 'Failed to find some of review message images.'
        ],
        'success' => 'Review message images has been successfully deleted.'
    ]
];
