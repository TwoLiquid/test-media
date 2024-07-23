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

    'support_ticket_message_videos_ids' => [
        'required' => __('validations.api.general.support.ticket.message.video.destroyMany.support_ticket_message_videos_ids.required'),
        'array'    => __('validations.api.general.support.ticket.message.video.destroyMany.support_ticket_message_videos_ids.array'),
        '*' => [
            'required' => __('validations.api.general.support.ticket.message.video.destroyMany.support_ticket_message_videos_ids.*.required'),
            'string'   => __('validations.api.general.support.ticket.message.video.destroyMany.support_ticket_message_videos_ids.*.string'),
            'exists'   => __('validations.api.general.support.ticket.message.video.destroyMany.support_ticket_message_videos_ids.*.exists')
        ]
    ],
    'result' => [
        'error' => [
            'find' => 'Failed to find some of support ticket message videos.'
        ],
        'success' => __('validations.api.general.support.ticket.message.video.destroyMany.result.success')
    ]
];
