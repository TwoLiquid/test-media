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

    'likes' => [
        'required' => __('validations.api.general.user.image.updateLikes.likes.required'),
        'integer'  => __('validations.api.general.user.image.updateLikes.likes.integer')
    ],
    'result' => [
        'error' => [
            'find' => __('validations.api.general.user.image.updateLikes.result.error.find')
        ],
        'success' => __('validations.api.general.user.image.updateLikes.result.success')
    ]
];
