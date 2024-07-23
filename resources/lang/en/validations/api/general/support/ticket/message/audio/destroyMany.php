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

    'support_ticket_message_audios_ids' => [
        'required' => __('validations.api.general.support.ticket.message.audio.destroyMany.support_ticket_message_audios_ids.required'),
        'array'    => __('validations.api.general.support.ticket.message.audio.destroyMany.support_ticket_message_audios_ids.array'),
        '*' => [
            'required' => __('validations.api.general.support.ticket.message.audio.destroyMany.support_ticket_message_audios_ids.*.required'),
            'string'   => __('validations.api.general.support.ticket.message.audio.destroyMany.support_ticket_message_audios_ids.*.string'),
            'exists'   => __('validations.api.general.support.ticket.message.audio.destroyMany.support_ticket_message_audios_ids.*.exists')
        ]
    ],
    'result' => [
        'error' => [
            'find' => 'Failed to find some of support ticket message audios.'
        ],
        'success' => __('validations.api.general.support.ticket.message.audio.destroyMany.result.success')
    ]
];
