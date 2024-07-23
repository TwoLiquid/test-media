<?php

namespace App\Http\Requests\Api\General\Chat\Message\Document;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Chat\Message\Document
 */
class DestroyManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'chat_message_documents_ids'   => 'required|array',
            'chat_message_documents_ids.*' => 'required|integer|exists:chat_message_documents,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'chat_message_documents_ids.required'   => trans('validations/api/general/chat/message/document/destroyMany.chat_message_documents_ids.required'),
            'chat_message_documents_ids.array'      => trans('validations/api/general/chat/message/document/destroyMany.chat_message_documents_ids.array'),
            'chat_message_documents_ids.*.required' => trans('validations/api/general/chat/message/document/destroyMany.chat_message_documents_ids.*.required'),
            'chat_message_documents_ids.*.integer'  => trans('validations/api/general/chat/message/document/destroyMany.chat_message_documents_ids.*.integer'),
            'chat_message_documents_ids.*.exists'   => trans('validations/api/general/chat/message/document/destroyMany.chat_message_documents_ids.*.exists')
        ];
    }
}
