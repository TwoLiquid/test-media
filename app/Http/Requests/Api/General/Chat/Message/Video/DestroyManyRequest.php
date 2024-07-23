<?php

namespace App\Http\Requests\Api\General\Chat\Message\Video;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Chat\Message\Video
 */
class DestroyManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'chat_message_videos_ids'   => 'required|array',
            'chat_message_videos_ids.*' => 'required|integer|exists:chat_message_videos,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'chat_message_videos_ids.required'   => trans('validations/api/general/chat/message/video/destroyMany.chat_message_videos_ids.required'),
            'chat_message_videos_ids.array'      => trans('validations/api/general/chat/message/video/destroyMany.chat_message_videos_ids.array'),
            'chat_message_videos_ids.*.required' => trans('validations/api/general/chat/message/video/destroyMany.chat_message_videos_ids.*.required'),
            'chat_message_videos_ids.*.integer'  => trans('validations/api/general/chat/message/video/destroyMany.chat_message_videos_ids.*.integer'),
            'chat_message_videos_ids.*.exists'   => trans('validations/api/general/chat/message/video/destroyMany.chat_message_videos_ids.*.exists')
        ];
    }
}
