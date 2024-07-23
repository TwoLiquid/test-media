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

    'chat_message_videos_ids' => [
        'required' => __('validations.api.general.chat.message.video.destroyMany.chat_message_videos_ids.required'),
        'array'    => __('validations.api.general.chat.message.video.destroyMany.chat_message_videos_ids.array'),
        '*' => [
            'required' => 'The chat message video id field is required.',
            'string'   => __('validations.api.general.chat.message.video.destroyMany.chat_message_videos_ids.*.string'),
            'exists'   => __('validations.api.general.chat.message.video.destroyMany.chat_message_videos_ids.*.exists')
        ]
    ],
    'result' => [
        'error' => [
            'find' => 'Failed to find some of chat message videos.'
        ],
        'success' => __('validations.api.general.chat.message.video.destroyMany.result.success')
    ]
];
