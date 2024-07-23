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

    'limit' => [
        'required' => __('validations.api.general.user.sticker.getFeatured.limit.required'),
        'integer'  => __('validations.api.general.user.sticker.getFeatured.limit.integer')
    ],
    'next' => [
        'string' => __('validations.api.general.user.sticker.getFeatured.next.string')
    ],
    'result' => [
        'success' => __('validations.api.general.user.sticker.getFeatured.result.success')
    ]
];
