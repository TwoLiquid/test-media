<?php

namespace App\Http\Requests\Api\General\Chat\Message\Audio;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Chat\Message\Audio
 */
class DestroyManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'chat_message_audios_ids'   => 'required|array',
            'chat_message_audios_ids.*' => 'required|integer|exists:chat_message_audios,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'chat_message_audios_ids.required'   => trans('validations/api/general/chat/message/audio/destroyMany.chat_message_audios_ids.required'),
            'chat_message_audios_ids.array'      => trans('validations/api/general/chat/message/audio/destroyMany.chat_message_audios_ids.array'),
            'chat_message_audios_ids.*.required' => trans('validations/api/general/chat/message/audio/destroyMany.chat_message_audios_ids.*.required'),
            'chat_message_audios_ids.*.integer'  => trans('validations/api/general/chat/message/audio/destroyMany.chat_message_audios_ids.*.integer'),
            'chat_message_audios_ids.*.exists'   => trans('validations/api/general/chat/message/audio/destroyMany.chat_message_audios_ids.*.exists')
        ];
    }
}
