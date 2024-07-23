<?php

namespace App\Http\Requests\Api\General\Support\Ticket\Message\Document;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Support\Ticket\Message\Document
 */
class DestroyManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'support_ticket_message_documents_ids'   => 'required|array',
            'support_ticket_message_documents_ids.*' => 'required|integer|exists:support_ticket_message_documents,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'support_ticket_message_documents_ids.required'   => trans('validations/api/general/support/ticket/message/document/destroyMany.support_ticket_message_documents_ids.required'),
            'support_ticket_message_documents_ids.array'      => trans('validations/api/general/support/ticket/message/document/destroyMany.support_ticket_message_documents_ids.array'),
            'support_ticket_message_documents_ids.*.required' => trans('validations/api/general/support/ticket/message/document/destroyMany.support_ticket_message_documents_ids.*.required'),
            'support_ticket_message_documents_ids.*.integer'  => trans('validations/api/general/support/ticket/message/document/destroyMany.support_ticket_message_documents_ids.*.integer'),
            'support_ticket_message_documents_ids.*.exists'   => trans('validations/api/general/support/ticket/message/document/destroyMany.support_ticket_message_documents_ids.*.exists')
        ];
    }
}
