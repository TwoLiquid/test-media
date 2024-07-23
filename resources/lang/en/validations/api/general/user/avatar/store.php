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
        'string' => __('validations.api.general.user.avatar.store.request_id.string')
    ],
    'content' => [
        'required' => __('validations.api.general.user.avatar.store.content.required'),
        'string'   => __('validations.api.general.user.avatar.store.content.string')
    ],
    'mime' => [
        'required' => __('validations.api.general.user.avatar.store.mime.required'),
        'string'   => __('validations.api.general.user.avatar.store.mime.string')
    ],
    'extension' => [
        'required' => __('validations.api.general.user.avatar.store.extension.required'),
        'string'   => __('validations.api.general.user.avatar.store.extension.string')
    ],
    'declined' => [
        'boolean' => __('validations.api.general.user.avatar.store.declined.boolean')
    ],
    'result' => [
        'error'   => __('validations.api.general.user.avatar.store.result.error'),
        'success' => __('validations.api.general.user.avatar.store.result.success')
    ]
];
