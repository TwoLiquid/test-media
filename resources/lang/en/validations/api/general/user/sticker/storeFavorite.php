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

    'external_id' => [
        'required' => __('validations.api.general.user.sticker.storeFavorite.external_id.required'),
        'string'   => __('validations.api.general.user.sticker.storeFavorite.external_id.string')
    ],
    'result' => [
        'error' => [
            'exists' => __('validations.api.general.user.sticker.storeFavorite.result.error.exists')
        ],
        'success' => __('validations.api.general.user.sticker.storeFavorite.result.success')
    ]
];
