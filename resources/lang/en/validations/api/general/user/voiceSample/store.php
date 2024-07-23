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
        'string' => __('validations.api.general.user.voiceSample.store.request_id.string')
    ],
    'content' => [
        'required' => __('validations.api.general.user.voiceSample.store.content.required'),
        'string'   => __('validations.api.general.user.voiceSample.store.content.string')
    ],
    'mime' => [
        'required' => __('validations.api.general.user.voiceSample.store.mime.required'),
        'string'   => __('validations.api.general.user.voiceSample.store.mime.string')
    ],
    'extension' => [
        'required' => __('validations.api.general.user.voiceSample.store.extension.required'),
        'string'   => __('validations.api.general.user.voiceSample.store.extension.string')
    ],
    'declined' => [
        'boolean' => __('validations.api.general.user.voiceSample.store.declined.boolean')
    ],
    'result' => [
        'error'   => __('validations.api.general.user.voiceSample.store.result.error'),
        'success' => __('validations.api.general.user.voiceSample.store.result.success')
    ]
];
