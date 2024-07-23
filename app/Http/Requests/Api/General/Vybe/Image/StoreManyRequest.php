<?php

namespace App\Http\Requests\Api\General\Vybe\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Vybe\Image
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'vybe_images'             => 'required|array',
            'vybe_images.*.content'   => 'required|string',
            'vybe_images.*.mime'      => 'required|string',
            'vybe_images.*.extension' => 'required|string',
            'vybe_images.*.main'      => 'boolean|nullable',
            'vybe_images.*.declined'  => 'boolean|nullable'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'vybe_images.required'             => trans('validations/api/general/vybe/image/storeMany.vybe_images.required'),
            'vybe_images.array'                => trans('validations/api/general/vybe/image/storeMany.vybe_images.array'),
            'vybe_images.*.content.required'   => trans('validations/api/general/vybe/image/storeMany.vybe_images.*.content.required'),
            'vybe_images.*.content.string'     => trans('validations/api/general/vybe/image/storeMany.vybe_images.*.content.string'),
            'vybe_images.*.mime.required'      => trans('validations/api/general/vybe/image/storeMany.vybe_images.*.mime.required'),
            'vybe_images.*.mime.string'        => trans('validations/api/general/vybe/image/storeMany.vybe_images.*.mime.string'),
            'vybe_images.*.extension.required' => trans('validations/api/general/vybe/image/storeMany.vybe_images.*.extension.required'),
            'vybe_images.*.extension.string'   => trans('validations/api/general/vybe/image/storeMany.vybe_images.*.extension.string'),
            'vybe_images.*.main.boolean'       => trans('validations/api/general/vybe/image/storeMany.vybe_images.*.main.boolean'),
            'vybe_images.*.declined.boolean'   => trans('validations/api/general/vybe/image/storeMany.vybe_images.*.declined.boolean')
        ];
    }
}
