<?php

namespace App\Http\Requests\Api\General\Alert\Sound;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class StoreManyRequest
 *
 * @package App\Http\Requests\Api\General\Alert\Sound
 */
class StoreManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'alert_sounds'             => 'required|array',
            'alert_sounds.*.content'   => 'required|string',
            'alert_sounds.*.extension' => 'required|string',
            'alert_sounds.*.mime'      => 'required|string'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'alert_sounds.required'             => trans('validations/api/general/alert/sound/storeMany.alert_sounds.required'),
            'alert_sounds.array'                => trans('validations/api/general/alert/sound/storeMany.alert_sounds.array'),
            'alert_sounds.*.content.required'   => trans('validations/api/general/alert/sound/storeMany.alert_sounds.*.content.required'),
            'alert_sounds.*.content.string'     => trans('validations/api/general/alert/sound/storeMany.alert_sounds.*.content.string'),
            'alert_sounds.*.extension.required' => trans('validations/api/general/alert/sound/storeMany.alert_sounds.*.extension.required'),
            'alert_sounds.*.extension.string'   => trans('validations/api/general/alert/sound/storeMany.alert_sounds.*.extension.string'),
            'alert_sounds.*.mime.required'      => trans('validations/api/general/alert/sound/storeMany.alert_sounds.*.mime.required'),
            'alert_sounds.*.mime.string'        => trans('validations/api/general/alert/sound/storeMany.alert_sounds.*.mime.string')
        ];
    }
}
