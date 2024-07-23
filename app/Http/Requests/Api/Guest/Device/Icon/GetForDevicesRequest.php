<?php

namespace App\Http\Requests\Api\Guest\Device\Icon;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForDevicesRequest
 *
 * @package App\Http\Requests\Api\Guest\Device\Icon
 */
class GetForDevicesRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'devices_ids'   => 'required|array',
            'devices_ids.*' => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'devices_ids.required'   => trans('validations/api/guest/device/icon/getForDevices.devices_ids.required'),
            'devices_ids.array'      => trans('validations/api/guest/device/icon/getForDevices.devices_ids.array'),
            'devices_ids.*.required' => trans('validations/api/guest/device/icon/getForDevices.devices_ids.*.required'),
            'devices_ids.*.integer'  => trans('validations/api/guest/device/icon/getForDevices.devices_ids.*.integer'),
            'devices_ids.*.exists'   => trans('validations/api/guest/device/icon/getForDevices.devices_ids.*.exists')
        ];
    }
}
