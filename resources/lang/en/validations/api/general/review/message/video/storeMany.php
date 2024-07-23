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

    'review_message_videos' => [
        'required' => 'The chat message videos field is required.',
        'array'    => 'The chat message videos field must be an array.',
        '*' => [
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
            ]
        ]
    ],
    'result' => [
        'success' => 'Review message videos have been successfully stored.'
    ]
];
