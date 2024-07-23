<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Api General Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error
    | messages used by the validator class
    |
    */

    'devices_ids' => [
        'required' => __('validations.api.guest.device.icon.getForDevices.devices_ids.required'),
        'array'    => __('validations.api.guest.device.icon.getForDevices.devices_ids.array'),
        '*' => [
            'required' => 'The device id field is required.',
            'string'   => __('validations.api.guest.device.icon.getForDevices.devices_ids.*.string'),
            'exists'   => __('validations.api.guest.device.icon.getForDevices.devices_ids.*.exists')
        ]
    ],
    'result' => [
        'success' => __('validations.api.guest.device.icon.getForDevices.result.success')
    ]
];
