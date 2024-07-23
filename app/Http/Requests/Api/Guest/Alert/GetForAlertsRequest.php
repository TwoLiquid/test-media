<?php

namespace App\Http\Requests\Api\Guest\Alert;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForAlertsRequest
 *
 * @package App\Http\Requests\Api\Guest\Alert
 */
class GetForAlertsRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'alerts_ids'   => 'required|array',
            'alerts_ids.*' => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'alerts_ids.required'   => trans('validations/api/guest/alert/getForAlerts.alerts_ids.required'),
            'alerts_ids.array'      => trans('validations/api/guest/alert/getForAlerts.alerts_ids.array'),
            'alerts_ids.*.required' => trans('validations/api/guest/alert/getForAlerts.alerts_ids.*.required'),
            'alerts_ids.*.integer'  => trans('validations/api/guest/alert/getForAlerts.alerts_ids.*.integer'),
            'alerts_ids.*.exists'   => trans('validations/api/guest/alert/getForAlerts.alerts_ids.*.exists')
        ];
    }
}
