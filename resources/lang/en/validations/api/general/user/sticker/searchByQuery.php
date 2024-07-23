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

    'query' => [
        'required' => __('validations.api.general.user.sticker.searchByQuery.query.required'),
        'string'   => __('validations.api.general.user.sticker.searchByQuery.query.string')
    ],
    'limit' => [
        'required' => __('validations.api.general.user.sticker.searchByQuery.limit.required'),
        'integer'  => __('validations.api.general.user.sticker.searchByQuery.limit.integer')
    ],
    'next' => [
        'string' => __('validations.api.general.user.sticker.searchByQuery.next.string')
    ],
    'result' => [
        'success' => __('validations.api.general.user.sticker.searchByQuery.result.success')
    ]
];
