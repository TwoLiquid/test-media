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
        'required' => __('validations.api.general.support.ticket.message.audio.store.content.required'),
        'string'   => __('validations.api.general.support.ticket.message.audio.store.content.string')
    ],
    'mime' => [
        'required' => __('validations.api.general.support.ticket.message.audio.store.mime.required'),
        'string'   => __('validations.api.general.support.ticket.message.audio.store.mime.string')
    ],
    'extension' => [
        'required' => __('validations.api.general.support.ticket.message.audio.store.extension.required'),
        'string'   => __('validations.api.general.support.ticket.message.audio.store.extension.string')
    ],
    'result' => [
        'error'   => __('validations.api.general.support.ticket.message.audio.store.result.error'),
        'success' => __('validations.api.general.support.ticket.message.audio.store.result.success')
    ]
];
