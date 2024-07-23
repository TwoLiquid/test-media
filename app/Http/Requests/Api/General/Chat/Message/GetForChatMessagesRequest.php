<?php

namespace App\Http\Requests\Api\General\Chat\Message;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForChatMessagesRequest
 *
 * @package App\Http\Requests\Api\General\Chat\Message
 */
class GetForChatMessagesRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'chat_messages_ids'   => 'required|array',
            'chat_messages_ids.*' => 'required|string',
            'auth_ids'            => 'required|array',
            'auth_ids.*'          => 'required|integer',
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'chat_messages_ids.required'   => trans('validations/api/general/chat/message/getForChatMessages.chat_messages_ids.required'),
            'chat_messages_ids.array'      => trans('validations/api/general/chat/message/getForChatMessages.chat_messages_ids.array'),
            'chat_messages_ids.*.required' => trans('validations/api/general/chat/message/getForChatMessages.chat_messages_ids.*.required'),
            'chat_messages_ids.*.string'   => trans('validations/api/general/chat/message/getForChatMessages.chat_messages_ids.*.string'),
            'auth_ids.required'            => trans('validations/api/general/chat/message/getForChatMessages.auth_ids.required'),
            'auth_ids.array'               => trans('validations/api/general/chat/message/getForChatMessages.auth_ids.array'),
            'auth_ids.*.required'          => trans('validations/api/general/chat/message/getForChatMessages.auth_ids.*.required'),
            'auth_ids.*.integer'           => trans('validations/api/general/chat/message/getForChatMessages.auth_ids.*.integer')
        ];
    }
}
