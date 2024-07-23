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
        'required' => __('validations.api.general.support.ticket.message.document.store.content.required'),
        'string'   => __('validations.api.general.support.ticket.message.document.store.content.string')
    ],
    'original_name' => [
        'string' => __('validations.api.general.support.ticket.message.document.store.original_name.string')
    ],
    'mime' => [
        'required' => __('validations.api.general.support.ticket.message.document.store.mime.required'),
        'string'   => __('validations.api.general.support.ticket.message.document.store.mime.string')
    ],
    'extension' => [
        'required' => __('validations.api.general.support.ticket.message.document.store.extension.required'),
        'string'   => __('validations.api.general.support.ticket.message.document.store.extension.string')
    ],
    'result' => [
        'error'   => __('validations.api.general.support.ticket.message.document.store.result.error'),
        'success' => __('validations.api.general.support.ticket.message.document.store.result.success')
    ]
];
