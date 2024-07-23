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

    'support_ticket_message_images_ids' => [
        'required' => __('validations.api.general.support.ticket.message.image.destroyMany.support_ticket_message_images_ids.required'),
        'array'    => __('validations.api.general.support.ticket.message.image.destroyMany.support_ticket_message_images_ids.array'),
        '*' => [
            'required' => __('validations.api.general.support.ticket.message.image.destroyMany.support_ticket_message_images_ids.*.required'),
            'string'   => __('validations.api.general.support.ticket.message.image.destroyMany.support_ticket_message_images_ids.*.string'),
            'exists'   => __('validations.api.general.support.ticket.message.image.destroyMany.support_ticket_message_images_ids.*.exists')
        ]
    ],
    'result' => [
        'error' => [
            'find' => 'Failed to find some of support ticket message images.'
        ],
        'success' => __('validations.api.general.support.ticket.message.image.destroyMany.result.success')
    ]
];
