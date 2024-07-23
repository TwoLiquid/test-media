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

    'review_message_videos_ids' => [
        'required' => 'The review message videos ids field is required.',
        'array'    => 'The review message videos ids field must be an array.',
        '*' => [
            'required' => 'The review message video id field is required.',
            'string'   => 'The review message video id field must be a string.',
            'exists'   => 'The selected review message video id field is invalid.'
        ]
    ],
    'result' => [
        'error' => [
            'find' => 'Failed to find some of review message videos.'
        ],
        'success' => 'Review message videos has been successfully deleted.'
    ]
];
