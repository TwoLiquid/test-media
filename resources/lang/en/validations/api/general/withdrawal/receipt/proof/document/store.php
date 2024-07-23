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
        'required' => __('validations.api.general.withdrawal.receipt.proof.document.store.content.required'),
        'string'   => __('validations.api.general.withdrawal.receipt.proof.document.store.content.string')
    ],
    'mime' => [
        'required' => __('validations.api.general.withdrawal.receipt.proof.document.store.mime.required'),
        'string'   => __('validations.api.general.withdrawal.receipt.proof.document.store.mime.string')
    ],
    'extension' => [
        'required' => __('validations.api.general.withdrawal.receipt.proof.document.store.extension.required'),
        'string'   => __('validations.api.general.withdrawal.receipt.proof.document.store.extension.string')
    ],
    'result' => [
        'success' => __('validations.api.general.withdrawal.receipt.proof.document.store.result.success')
    ]
];
