<?php

namespace App\Http\Requests\Api\General\User\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\Guest\User\Image
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'user_images'              => 'required|array',
            'user_images.*.request_id' => 'string|nullable',
            'user_images.*.content'    => 'required|string',
            'user_images.*.mime'       => 'required|string',
            'user_images.*.extension'  => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'user_images.required'             => trans('validations/api/general/user/image/storeMany.user_images.required'),
            'user_images.array'                => trans('validations/api/general/user/image/storeMany.user_images.array'),
            'user_images.*.request_id.string'  => trans('validations/api/general/user/image/storeMany.user_images.*.request_id.string'),
            'user_images.*.content.required'   => trans('validations/api/general/user/image/storeMany.user_images.*.content.required'),
            'user_images.*.content.string'     => trans('validations/api/general/user/image/storeMany.user_images.*.content.string'),
            'user_images.*.mime.required'      => trans('validations/api/general/user/image/storeMany.user_images.*.mime.required'),
            'user_images.*.mime.string'        => trans('validations/api/general/user/image/storeMany.user_images.*.mime.string'),
            'user_images.*.extension.required' => trans('validations/api/general/user/image/storeMany.user_images.*.extension.required'),
            'user_images.*.extension.string'   => trans('validations/api/general/user/image/storeMany.user_images.*.extension.string')
        ];
    }
}
