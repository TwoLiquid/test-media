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

    'chat_message_images_ids' => [
        'required' => __('validations.api.general.chat.message.image.destroyMany.chat_message_images_ids.required'),
        'array'    => __('validations.api.general.chat.message.image.destroyMany.chat_message_images_ids.array'),
        '*' => [
            'required' => 'The chat message image id field is required.',
            'string'   => __('validations.api.general.chat.message.image.destroyMany.chat_message_images_ids.*.string'),
            'exists'   => __('validations.api.general.chat.message.image.destroyMany.chat_message_images_ids.*.exists')
        ]
    ],
    'result' => [
        'error' => [
            'find' => 'Failed to find some of chat message images.'
        ],
        'success' => __('validations.api.general.chat.message.image.destroyMany.result.success')
    ]
];
