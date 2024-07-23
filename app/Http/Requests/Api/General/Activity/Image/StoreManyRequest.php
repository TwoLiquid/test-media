<?php

namespace App\Http\Requests\Api\General\Activity\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Activity\Image
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'activity_images'             => 'required|array',
            'activity_images.*.content'   => 'required|string',
            'activity_images.*.mime'      => 'required|string',
            'activity_images.*.extension' => 'required|string',
            'activity_images.*.type'      => 'required|string|in:poster,avatar,background'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'activity_images.required'             => trans('validations/api/general/activity/image/storeMany.activity_images.required'),
            'activity_images.array'                => trans('validations/api/general/activity/image/storeMany.activity_images.array'),
            'activity_images.*.content.required'   => trans('validations/api/general/activity/image/storeMany.activity_images.*.content.required'),
            'activity_images.*.content.string'     => trans('validations/api/general/activity/image/storeMany.activity_images.*.content.string'),
            'activity_images.*.mime.required'      => trans('validations/api/general/activity/image/storeMany.activity_images.*.mime.required'),
            'activity_images.*.mime.string'        => trans('validations/api/general/activity/image/storeMany.activity_images.*.mime.string'),
            'activity_images.*.extension.required' => trans('validations/api/general/activity/image/storeMany.activity_images.*.extension.required'),
            'activity_images.*.extension.string'   => trans('validations/api/general/activity/image/storeMany.activity_images.*.extension.string'),
            'activity_images.*.type.required'      => trans('validations/api/general/activity/image/storeMany.activity_images.*.type.required'),
            'activity_images.*.type.string'        => trans('validations/api/general/activity/image/storeMany.activity_images.*.type.string'),
            'activity_images.*.type.in'            => trans('validations/api/general/activity/image/storeMany.activity_images.*.type.in')
        ];
    }
}
