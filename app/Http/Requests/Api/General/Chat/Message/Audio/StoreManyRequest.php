<?php

namespace App\Http\Requests\Api\General\Chat\Message\Audio;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Chat\Message\Audio
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'chat_message_audios'             => 'required|array',
            'chat_message_audios.*.content'   => 'required|string',
            'chat_message_audios.*.mime'      => 'required|string',
            'chat_message_audios.*.extension' => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'chat_message_audios.required'             => trans('validations/api/general/chat/message/audio/storeMany.chat_message_audios.required'),
            'chat_message_audios.array'                => trans('validations/api/general/chat/message/audio/storeMany.chat_message_audios.array'),
            'chat_message_audios.*.content.required'   => trans('validations/api/general/chat/message/audio/storeMany.chat_message_audios.*.content.required'),
            'chat_message_audios.*.content.string'     => trans('validations/api/general/chat/message/audio/storeMany.chat_message_audios.*.content.string'),
            'chat_message_audios.*.mime.required'      => trans('validations/api/general/chat/message/audio/storeMany.chat_message_audios.*.mime.required'),
            'chat_message_audios.*.mime.string'        => trans('validations/api/general/chat/message/audio/storeMany.chat_message_audios.*.mime.string'),
            'chat_message_audios.*.extension.required' => trans('validations/api/general/chat/message/audio/storeMany.chat_message_audios.*.extension.required'),
            'chat_message_audios.*.extension.string'   => trans('validations/api/general/chat/message/audio/storeMany.chat_message_audios.*.extension.string')
        ];
    }
}
