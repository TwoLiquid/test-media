<?php

namespace App\Http\Requests\Api\General\Review\Message\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Review\Message\Image
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'review_message_images'             => 'required|array',
            'review_message_images.*.content'   => 'required|string',
            'review_message_images.*.extension' => 'required|string',
            'review_message_images.*.mime'      => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'review_message_images.required'             => trans('validations/api/general/review/message/image/storeMany.review_message_images.required'),
            'review_message_images.array'                => trans('validations/api/general/review/message/image/storeMany.review_message_images.array'),
            'review_message_images.*.content.required'   => trans('validations/api/general/review/message/image/storeMany.review_message_images.*.content.required'),
            'review_message_images.*.content.string'     => trans('validations/api/general/review/message/image/storeMany.review_message_images.*.content.string'),
            'review_message_images.*.extension.required' => trans('validations/api/general/review/message/image/storeMany.review_message_images.*.extension.required'),
            'review_message_images.*.extension.string'   => trans('validations/api/general/review/message/image/storeMany.review_message_images.*.extension.string'),
            'review_message_images.*.mime.required'      => trans('validations/api/general/review/message/image/storeMany.review_message_images.*.mime.required'),
            'review_message_images.*.mime.string'        => trans('validations/api/general/review/message/image/storeMany.review_message_images.*.mime.string')
        ];
    }
}
