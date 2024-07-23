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

    'content' => [
        'required' => __('validations.api.general.platform.icon.store.content.required'),
        'string'   => __('validations.api.general.platform.icon.store.content.string')
    ],
    'mime' => [
        'required' => __('validations.api.general.platform.icon.store.mime.required'),
        'string'   => __('validations.api.general.platform.icon.store.mime.string')
    ],
    'extension' => [
        'required' => __('validations.api.general.platform.icon.store.extension.required'),
        'string'   => __('validations.api.general.platform.icon.store.extension.string')
    ],
    'result' => [
        'error'   => __('validations.api.general.platform.icon.store.result.error'),
        'success' => __('validations.api.general.platform.icon.store.result.success')
    ]
];
