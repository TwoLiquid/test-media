<?php

namespace App\Http\Requests\Api\General\Support\Ticket\Message\Document;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Support\Ticket\Message\Document
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'support_ticket_message_documents'                 => 'required|array',
            'support_ticket_message_documents.*.content'       => 'required|string',
            'support_ticket_message_documents.*.original_name' => 'string|nullable',
            'support_ticket_message_documents.*.extension'     => 'required|string',
            'support_ticket_message_documents.*.mime'          => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'support_ticket_message_documents.required'               => trans('validations/api/general/support/ticket/message/document/storeMany.support_ticket_message_documents.required'),
            'support_ticket_message_documents.array'                  => trans('validations/api/general/support/ticket/message/document/storeMany.support_ticket_message_documents.array'),
            'support_ticket_message_documents.*.content.required'     => trans('validations/api/general/support/ticket/message/document/storeMany.support_ticket_message_documents.*.content.required'),
            'support_ticket_message_documents.*.content.string'       => trans('validations/api/general/support/ticket/message/document/storeMany.support_ticket_message_documents.*.content.string'),
            'support_ticket_message_documents.*.original_name.string' => trans('validations/api/general/support/ticket/message/document/storeMany.support_ticket_message_documents.*.original_name.string'),
            'support_ticket_message_documents.*.extension.required'   => trans('validations/api/general/support/ticket/message/document/storeMany.support_ticket_message_documents.*.extension.required'),
            'support_ticket_message_documents.*.extension.string'     => trans('validations/api/general/support/ticket/message/document/storeMany.support_ticket_message_documents.*.extension.string'),
            'support_ticket_message_documents.*.mime.required'        => trans('validations/api/general/support/ticket/message/document/storeMany.support_ticket_message_documents.*.mime.required'),
            'support_ticket_message_documents.*.mime.string'          => trans('validations/api/general/support/ticket/message/document/storeMany.support_ticket_message_documents.*.mime.string')
        ];
    }
}
