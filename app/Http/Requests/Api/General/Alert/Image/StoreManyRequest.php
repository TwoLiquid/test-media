<?php

namespace App\Http\Requests\Api\General\Alert\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Alert\Image
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'alert_images'             => 'required|array',
            'alert_images.*.content'   => 'required|string',
            'alert_images.*.extension' => 'required|string',
            'alert_images.*.mime'      => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'alert_images.required'             => trans('validations/api/general/alert/image/storeMany.alert_images.required'),
            'alert_images.array'                => trans('validations/api/general/alert/image/storeMany.alert_images.array'),
            'alert_images.*.content.required'   => trans('validations/api/general/alert/image/storeMany.alert_images.*.content.required'),
            'alert_images.*.content.string'     => trans('validations/api/general/alert/image/storeMany.alert_images.*.content.string'),
            'alert_images.*.extension.required' => trans('validations/api/general/alert/image/storeMany.alert_images.*.extension.required'),
            'alert_images.*.extension.string'   => trans('validations/api/general/alert/image/storeMany.alert_images.*.extension.string'),
            'alert_images.*.mime.required'      => trans('validations/api/general/alert/image/storeMany.alert_images.*.mime.required'),
            'alert_images.*.mime.string'        => trans('validations/api/general/alert/image/storeMany.alert_images.*.mime.string')
        ];
    }
}
