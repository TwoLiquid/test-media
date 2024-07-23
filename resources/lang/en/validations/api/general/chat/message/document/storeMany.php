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

    'chat_message_documents' => [
        'required' => __('validations.api.general.chat.message.document.storeMany.chat_message_documents.required'),
        'array'    => __('validations.api.general.chat.message.document.storeMany.chat_message_documents.array'),
        '*' => [
            'content' => [
                'required' => __('validations.api.general.chat.message.document.storeMany.chat_message_documents.*.content.required'),
                'string'   => __('validations.api.general.chat.message.document.storeMany.chat_message_documents.*.content.string')
            ],
            'original_name' => [
                'string' => __('validations.api.general.chat.message.document.storeMany.chat_message_documents.*.original_name.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.chat.message.document.storeMany.chat_message_documents.*.mime.required'),
                'string'   => __('validations.api.general.chat.message.document.storeMany.chat_message_documents.*.mime.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.chat.message.document.storeMany.chat_message_documents.*.extension.required'),
                'string'   => __('validations.api.general.chat.message.document.storeMany.chat_message_documents.*.extension.string')
            ]
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.chat.message.document.storeMany.result.success')
    ]
];
