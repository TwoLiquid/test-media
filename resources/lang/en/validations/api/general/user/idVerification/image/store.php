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
        'string' => __('validations.api.general.user.idVerification.image.store.request_id.string')
    ],
    'content' => [
        'required' => __('validations.api.general.user.idVerification.image.store.content.required'),
        'string'   => __('validations.api.general.user.idVerification.image.store.content.string')
    ],
    'mime' => [
        'required' => __('validations.api.general.user.idVerification.image.store.mime.required'),
        'string'   => __('validations.api.general.user.idVerification.image.store.mime.string')
    ],
    'extension' => [
        'required' => __('validations.api.general.user.idVerification.image.store.extension.required'),
        'string'   => __('validations.api.general.user.idVerification.image.store.extension.string')
    ],
    'result' => [
        'success' => __('validations.api.general.user.idVerification.image.store.result.success')
    ]
];
