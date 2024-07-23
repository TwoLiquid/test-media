<?php

namespace App\Http\Requests\Api\General\Chat\Message\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Chat\Message\Image
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'chat_message_images'             => 'required|array',
            'chat_message_images.*.content'   => 'required|string',
            'chat_message_images.*.extension' => 'required|string',
            'chat_message_images.*.mime'      => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'chat_message_images.required'             => trans('validations/api/general/chat/message/image/storeMany.chat_message_images.required'),
            'chat_message_images.array'                => trans('validations/api/general/chat/message/image/storeMany.chat_message_images.array'),
            'chat_message_images.*.content.required'   => trans('validations/api/general/chat/message/image/storeMany.chat_message_images.*.content.required'),
            'chat_message_images.*.content.string'     => trans('validations/api/general/chat/message/image/storeMany.chat_message_images.*.content.string'),
            'chat_message_images.*.extension.required' => trans('validations/api/general/chat/message/image/storeMany.chat_message_images.*.extension.required'),
            'chat_message_images.*.extension.string'   => trans('validations/api/general/chat/message/image/storeMany.chat_message_images.*.extension.string'),
            'chat_message_images.*.mime.required'      => trans('validations/api/general/chat/message/image/storeMany.chat_message_images.*.mime.required'),
            'chat_message_images.*.mime.string'        => trans('validations/api/general/chat/message/image/storeMany.chat_message_images.*.mime.string')
        ];
    }
}
