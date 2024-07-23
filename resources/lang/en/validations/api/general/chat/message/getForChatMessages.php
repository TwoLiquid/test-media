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

    'chat_messages_ids' => [
        'required' => __('validations.api.general.chat.message.getForChatMessages.chat_messages_ids.required'),
        'array'    => __('validations.api.general.chat.message.getForChatMessages.chat_messages_ids.array'),
        '*' => [
            'required' => 'The chat message id field is required.',
            'string'   => __('validations.api.general.chat.message.getForChatMessages.chat_messages_ids.*.string')
        ]
    ],
    'auth_ids' => [
        'required' => __('validations.api.general.chat.message.getForChatMessages.auth_ids.required'),
        'array'    => __('validations.api.general.chat.message.getForChatMessages.auth_ids.array'),
        '*' => [
            'required' => 'The auth id field is required.',
            'integer'  => __('validations.api.general.chat.message.getForChatMessages.auth_ids.*.integer')
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.chat.message.getForChatMessages.result.success')
    ]
];
