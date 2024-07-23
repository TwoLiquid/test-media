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

    'request_id' => [
        'string' => __('validations.api.general.user.background.store.request_id.string')
    ],
    'content' => [
        'required' => __('validations.api.general.user.background.store.content.required'),
        'string'   => __('validations.api.general.user.background.store.content.string')
    ],
    'mime' => [
        'required' => __('validations.api.general.user.background.store.mime.required'),
        'string'   => __('validations.api.general.user.background.store.mime.string')
    ],
    'extension' => [
        'required' => __('validations.api.general.user.background.store.extension.required'),
        'string'   => __('validations.api.general.user.background.store.extension.string')
    ],
    'declined' => [
        'boolean' => __('validations.api.general.user.background.store.declined.boolean')
    ],
    'result' => [
        'error'   => __('validations.api.general.user.background.store.result.error'),
        'success' => __('validations.api.general.user.background.store.result.success')
    ]
];
