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

    'support_ticket_documents_ids' => [
        'required' => __('validations.api.general.support.ticket.message.document.destroyMany.support_ticket_message_documents_ids.required'),
        'array'    => __('validations.api.general.support.ticket.message.document.destroyMany.support_ticket_message_documents_ids.array'),
        '*' => [
            'required' => __('validations.api.general.support.ticket.message.document.destroyMany.support_ticket_message_documents_ids.*.required'),
            'string'   => __('validations.api.general.support.ticket.message.document.destroyMany.support_ticket_message_documents_ids.*.string'),
            'exists'   => __('validations.api.general.support.ticket.message.document.destroyMany.support_ticket_message_documents_ids.*.exists')
        ]
    ],
    'result' => [
        'error' => [
            'find' => 'Failed to find some of support ticket message documents.'
        ],
        'success' => __('validations.api.general.support.ticket.message.document.destroyMany.result.success')
    ]
];
