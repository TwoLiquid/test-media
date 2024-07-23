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

    'support_ticket_message_videos' => [
        'required' => __('validations.api.general.support.ticket.message.video.storeMany.support_ticket_message_videos.required'),
        'array'    => __('validations.api.general.support.ticket.message.video.storeMany.support_ticket_message_videos.array'),
        '*' => [
            'content' => [
                'required' => __('validations.api.general.support.ticket.message.video.storeMany.support_ticket_message_videos.*.content.required'),
                'string'   => __('validations.api.general.support.ticket.message.video.storeMany.support_ticket_message_videos.*.content.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.support.ticket.message.video.storeMany.support_ticket_message_videos.*.mime.required'),
                'string'   => __('validations.api.general.support.ticket.message.video.storeMany.support_ticket_message_videos.*.mime.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.support.ticket.message.video.storeMany.support_ticket_message_videos.*.extension.required'),
                'string'   => __('validations.api.general.support.ticket.message.video.storeMany.support_ticket_message_videos.*.extension.string')
            ]
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.support.ticket.message.video.storeMany.result.success')
    ]
];