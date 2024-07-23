<?php

namespace App\Http\Requests\Api\General\Alert\Sound;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class DestroyManyRequest
 *
 * @package App\Http\Requests\Api\General\Alert\Sound
 */
class DestroyManyRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'alert_sounds_ids'   => 'required|array',
            'alert_sounds_ids.*' => 'required|integer|exists:alert_sounds,id'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'alert_sounds_ids.required'   => trans('validations/api/general/alert/sound/destroyMany.alert_sounds_ids.required'),
            'alert_sounds_ids.array'      => trans('validations/api/general/alert/sound/destroyMany.alert_sounds_ids.array'),
            'alert_sounds_ids.*.required' => trans('validations/api/general/alert/sound/destroyMany.alert_sounds_ids.*.required'),
            'alert_sounds_ids.*.integer'  => trans('validations/api/general/alert/sound/destroyMany.alert_sounds_ids.*.integer'),
            'alert_sounds_ids.*.exists'   => trans('validations/api/general/alert/sound/destroyMany.alert_sounds_ids.*.exists')
        ];
    }
}
