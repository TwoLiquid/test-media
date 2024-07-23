<?php

namespace App\Http\Requests\Api\General\Review\Message\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Review\Message\Image
 */
class DestroyManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'review_message_images_ids'   => 'required|array',
            'review_message_images_ids.*' => 'required|integer|exists:review_message_images,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'review_message_images_ids.required'   => trans('validations/api/general/review/message/image/destroyMany.review_message_images_ids.required'),
            'review_message_images_ids.array'      => trans('validations/api/general/review/message/image/destroyMany.review_message_images_ids.array'),
            'review_message_images_ids.*.required' => trans('validations/api/general/review/message/image/destroyMany.review_message_images_ids.*.required'),
            'review_message_images_ids.*.integer'  => trans('validations/api/general/review/message/image/destroyMany.review_message_images_ids.*.integer'),
            'review_message_images_ids.*.exists'   => trans('validations/api/general/review/message/image/destroyMany.review_message_images_ids.*.exists')
        ];
    }
}
