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

    'chat_message_audios' => [
        'required' => __('validations.api.general.chat.message.audio.storeMany.chat_message_audios.required'),
        'array'    => __('validations.api.general.chat.message.audio.storeMany.chat_message_audios.array'),
        '*' => [
            'content' => [
                'required' => __('validations.api.general.chat.message.audio.storeMany.chat_message_audios.*.content.required'),
                'string'   => __('validations.api.general.chat.message.audio.storeMany.chat_message_audios.*.content.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.chat.message.audio.storeMany.chat_message_audios.*.mime.required'),
                'string'   => __('validations.api.general.chat.message.audio.storeMany.chat_message_audios.*.mime.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.chat.message.audio.storeMany.chat_message_audios.*.extension.required'),
                'string'   => __('validations.api.general.chat.message.audio.storeMany.chat_message_audios.*.extension.string')
            ]
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.chat.message.audio.storeMany.result.success')
    ]
];
