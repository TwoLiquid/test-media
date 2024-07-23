<?php

namespace App\Http\Requests\Api\General\Chat\Message\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Chat\Message\Image
 */
class DestroyManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'chat_message_images_ids'   => 'required|array',
            'chat_message_images_ids.*' => 'required|integer|exists:chat_message_images,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'chat_message_images_ids.required'   => trans('validations/api/general/chat/message/image/destroyMany.chat_message_images_ids.required'),
            'chat_message_images_ids.array'      => trans('validations/api/general/chat/message/image/destroyMany.chat_message_images_ids.array'),
            'chat_message_images_ids.*.required' => trans('validations/api/general/chat/message/image/destroyMany.chat_message_images_ids.*.required'),
            'chat_message_images_ids.*.integer'  => trans('validations/api/general/chat/message/image/destroyMany.chat_message_images_ids.*.integer'),
            'chat_message_images_ids.*.exists'   => trans('validations/api/general/chat/message/image/destroyMany.chat_message_images_ids.*.exists')
        ];
    }
}
