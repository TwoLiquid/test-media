<?php

namespace App\Http\Requests\Api\General\Alert\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Alert\Image
 */
class DestroyManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'alert_images_ids'   => 'required|array',
            'alert_images_ids.*' => 'required|integer|exists:alert_images,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'alert_images_ids.required'   => trans('validations/api/general/alert/image/destroyMany.alert_images_ids.required'),
            'alert_images_ids.array'      => trans('validations/api/general/alert/image/destroyMany.alert_images_ids.array'),
            'alert_images_ids.*.required' => trans('validations/api/general/alert/image/destroyMany.alert_images_ids.*.required'),
            'alert_images_ids.*.integer'  => trans('validations/api/general/alert/image/destroyMany.alert_images_ids.*.integer'),
            'alert_images_ids.*.exists'   => trans('validations/api/general/alert/image/destroyMany.alert_images_ids.*.exists')
        ];
    }
}
