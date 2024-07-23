<?php

namespace App\Http\Requests\Api\General\Chat\Message\Document;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Chat\Message\Document
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'chat_message_documents'                 => 'required|array',
            'chat_message_documents.*.content'       => 'required|string',
            'chat_message_documents.*.original_name' => 'string|nullable',
            'chat_message_documents.*.extension'     => 'required|string',
            'chat_message_documents.*.mime'          => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'chat_message_documents.required'               => trans('validations/api/general/chat/message/document/storeMany.chat_message_documents.required'),
            'chat_message_documents.array'                  => trans('validations/api/general/chat/message/document/storeMany.chat_message_documents.array'),
            'chat_message_documents.*.content.required'     => trans('validations/api/general/chat/message/document/storeMany.chat_message_documents.*.content.required'),
            'chat_message_documents.*.content.string'       => trans('validations/api/general/chat/message/document/storeMany.chat_message_documents.*.content.string'),
            'chat_message_documents.*.original_name.string' => trans('validations/api/general/chat/message/document/storeMany.chat_message_documents.*.original_name.string'),
            'chat_message_documents.*.extension.required'   => trans('validations/api/general/chat/message/document/storeMany.chat_message_documents.*.extension.required'),
            'chat_message_documents.*.extension.string'     => trans('validations/api/general/chat/message/document/storeMany.chat_message_documents.*.extension.string'),
            'chat_message_documents.*.mime.required'        => trans('validations/api/general/chat/message/document/storeMany.chat_message_documents.*.mime.required'),
            'chat_message_documents.*.mime.string'          => trans('validations/api/general/chat/message/document/storeMany.chat_message_documents.*.mime.string')
        ];
    }
}
