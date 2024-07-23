<?php

namespace App\Http\Requests\Api\Guest\Vybe\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class ShowManyRequest
 *
 * @package App\Http\Requests\Api\Guest\Vybe\Image
 */
class ShowManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'vybe_images_ids'   => 'required|array',
            'vybe_images_ids.*' => 'required|integer|exists:vybe_images,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'vybe_images_ids.required'   => trans('validations/api/guest/vybe/image/showMany.vybe_images_ids.required'),
            'vybe_images_ids.array'      => trans('validations/api/guest/vybe/image/showMany.vybe_images_ids.array'),
            'vybe_images_ids.*.required' => trans('validations/api/guest/vybe/image/showMany.vybe_images_ids.*.required'),
            'vybe_images_ids.*.integer'  => trans('validations/api/guest/vybe/image/showMany.vybe_images_ids.*.integer'),
            'vybe_images_ids.*.exists'   => trans('validations/api/guest/vybe/image/showMany.vybe_images_ids.*.exists')
        ];
    }
}
