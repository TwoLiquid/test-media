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

    'support_ticket_messages_ids' => [
        'required' => __('validations.api.general.support.ticket.message.getForSupportTicketMessages.support_ticket_messages_ids.required'),
        'array'    => __('validations.api.general.support.ticket.message.getForSupportTicketMessages.support_ticket_messages_ids.array'),
        '*' => [
            'required' => __('validations.api.general.support.ticket.message.getForSupportTicketMessages.support_ticket_messages_ids.*.required'),
            'string'   => __('validations.api.general.support.ticket.message.getForSupportTicketMessages.support_ticket_messages_ids.*.string')
        ]
    ],
    'auth_ids' => [
        'required' => __('validations.api.general.support.ticket.message.getForSupportTicketMessages.auth_ids.required'),
        'array'    => __('validations.api.general.support.ticket.message.getForSupportTicketMessages.auth_ids.array'),
        '*' => [
            'required' => __('validations.api.general.support.ticket.message.getForSupportTicketMessages.auth_ids.*.required'),
            'integer'  => __('validations.api.general.support.ticket.message.getForSupportTicketMessages.auth_ids.*.integer')
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.support.ticket.message.getForSupportTicketMessages.result.success')
    ]
];
