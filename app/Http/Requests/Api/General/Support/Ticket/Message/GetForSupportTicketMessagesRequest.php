<?php

namespace App\Http\Requests\Api\General\Support\Ticket\Message;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForSupportTicketMessagesRequest
 *
 * @package App\Http\Requests\Api\General\Support\Ticket\Message
 */
class GetForSupportTicketMessagesRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'support_ticket_messages_ids'   => 'required|array',
            'support_ticket_messages_ids.*' => 'required|string',
            'auth_ids'                      => 'required|array',
            'auth_ids.*'                    => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'support_ticket_messages_ids.required'   => trans('validations/api/general/support/ticket/message/getForSupportTicketMessages.support_ticket_messages_ids.required'),
            'support_ticket_messages_ids.array'      => trans('validations/api/general/support/ticket/message/getForSupportTicketMessages.support_ticket_messages_ids.array'),
            'support_ticket_messages_ids.*.required' => trans('validations/api/general/support/ticket/message/getForSupportTicketMessages.support_ticket_messages_ids.*.required'),
            'support_ticket_messages_ids.*.string'   => trans('validations/api/general/support/ticket/message/getForSupportTicketMessages.support_ticket_messages_ids.*.string'),
            'auth_ids.required'                      => trans('validations/api/general/support/ticket/message/getForSupportTicketMessages.auth_ids.required'),
            'auth_ids.array'                         => trans('validations/api/general/support/ticket/message/getForSupportTicketMessages.auth_ids.array'),
            'auth_ids.*.required'                    => trans('validations/api/general/support/ticket/message/getForSupportTicketMessages.auth_ids.*.required'),
            'auth_ids.*.integer'                     => trans('validations/api/general/support/ticket/message/getForSupportTicketMessages.auth_ids.*.integer')
        ];
    }
}
