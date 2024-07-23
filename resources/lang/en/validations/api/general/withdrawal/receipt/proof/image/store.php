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
        'required' => __('validations.api.general.withdrawal.receipt.proof.image.store.content.required'),
        'string'   => __('validations.api.general.withdrawal.receipt.proof.image.store.content.string')
    ],
    'mime' => [
        'required' => __('validations.api.general.withdrawal.receipt.proof.image.store.mime.required'),
        'string'   => __('validations.api.general.withdrawal.receipt.proof.image.store.mime.string')
    ],
    'extension' => [
        'required' => __('validations.api.general.withdrawal.receipt.proof.image.store.extension.required'),
        'string'   => __('validations.api.general.withdrawal.receipt.proof.image.store.extension.string')
    ],
    'result' => [
        'success' => __('validations.api.general.withdrawal.receipt.proof.image.store.result.success')
    ]
];
