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

    'support_ticket_message_images' => [
        'required' => __('validations.api.general.support.ticket.message.image.storeMany.support_ticket_message_images.required'),
        'array'    => __('validations.api.general.support.ticket.message.image.storeMany.support_ticket_message_images.array'),
        '*' => [
            'content' => [
                'required' => __('validations.api.general.support.ticket.message.image.storeMany.support_ticket_message_images.*.content.required'),
                'string'   => __('validations.api.general.support.ticket.message.image.storeMany.support_ticket_message_images.*.content.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.support.ticket.message.image.storeMany.support_ticket_message_images.*.mime.required'),
                'string'   => __('validations.api.general.support.ticket.message.image.storeMany.support_ticket_message_images.*.mime.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.support.ticket.message.image.storeMany.support_ticket_message_images.*.extension.required'),
                'string'   => __('validations.api.general.support.ticket.message.image.storeMany.support_ticket_message_images.*.extension.string')
            ]
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.support.ticket.message.image.storeMany.result.success')
    ]
];
