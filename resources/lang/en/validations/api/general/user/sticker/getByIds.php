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

    'stickers_ids' => [
        'required' => 'The stickers ids field is required.',
        'array'    => 'The stickers ids field must be an array.',
        '*'        => [
            'required' => 'The sticker id field is required.',
            'string'   => 'The sticker id field must be a string.',
        ]
    ],
    'result' => [
        'success' => 'User stickers have been successfully received.'
    ]
];
