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

    'chat_message_audios_ids' => [
        'required' => __('validations.api.general.chat.message.audio.destroyMany.chat_message_audios_ids.required'),
        'array'    => __('validations.api.general.chat.message.audio.destroyMany.chat_message_audios_ids.array'),
        '*' => [
            'required' => 'The chat message audio id field is required.',
            'string'   => __('validations.api.general.chat.message.audio.destroyMany.chat_message_audios_ids.*.string'),
            'exists'   => __('validations.api.general.chat.message.audio.destroyMany.chat_message_audios_ids.*.exists')
        ]
    ],
    'result' => [
        'error' => [
            'find' => 'Failed to find some of chat message audios.'
        ],
        'success' => __('validations.api.general.chat.message.audio.destroyMany.result.success')
    ]
];
