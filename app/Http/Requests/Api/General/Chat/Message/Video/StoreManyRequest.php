<?php

namespace App\Http\Requests\Api\General\Chat\Message\Video;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Chat\Message\Video
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'chat_message_videos'             => 'required|array',
            'chat_message_videos.*.content'   => 'required|string',
            'chat_message_videos.*.extension' => 'required|string',
            'chat_message_videos.*.mime'      => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'chat_message_videos.required'             => trans('validations/api/general/chat/message/video/storeMany.chat_message_videos.required'),
            'chat_message_videos.array'                => trans('validations/api/general/chat/message/video/storeMany.chat_message_videos.array'),
            'chat_message_videos.*.content.required'   => trans('validations/api/general/chat/message/video/storeMany.chat_message_videos.*.content.required'),
            'chat_message_videos.*.content.string'     => trans('validations/api/general/chat/message/video/storeMany.chat_message_videos.*.content.string'),
            'chat_message_videos.*.extension.required' => trans('validations/api/general/chat/message/video/storeMany.chat_message_videos.*.extension.required'),
            'chat_message_videos.*.extension.string'   => trans('validations/api/general/chat/message/video/storeMany.chat_message_videos.*.extension.string'),
            'chat_message_videos.*.mime.required'      => trans('validations/api/general/chat/message/video/storeMany.chat_message_videos.*.mime.required'),
            'chat_message_videos.*.mime.string'        => trans('validations/api/general/chat/message/video/storeMany.chat_message_videos.*.mime.string')
        ];
    }
}
