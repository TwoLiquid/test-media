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

    'chat_message_documents_ids' => [
        'required' => __('validations.api.general.chat.message.document.destroyMany.chat_message_documents_ids.required'),
        'array'    => __('validations.api.general.chat.message.document.destroyMany.chat_message_documents_ids.array'),
        '*' => [
            'required' => 'The chat message document id field is required.',
            'string'   => __('validations.api.general.chat.message.document.destroyMany.chat_message_documents_ids.*.string'),
            'exists'   => __('validations.api.general.chat.message.document.destroyMany.chat_message_documents_ids.*.exists')
        ]
    ],
    'result' => [
        'error' => [
            'find' => 'Failed to find some of chat message documents.'
        ],
        'success' => __('validations.api.general.chat.message.document.destroyMany.result.success')
    ]
];
