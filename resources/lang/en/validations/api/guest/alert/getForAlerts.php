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

    'alerts_ids' => [
        'required' => __('validations.api.guest.alert.getForAlerts.alerts_ids.required'),
        'array'    => __('validations.api.guest.alert.getForAlerts.alerts_ids.array'),
        '*' => [
            'required' => 'The alert id field is required.',
            'string'   => __('validations.api.guest.alert.getForAlerts.alerts_ids.*.string'),
            'exists'   => __('validations.api.guest.alert.getForAlerts.alerts_ids.*.exists')
        ]
    ],
    'result' => [
        'success' => __('validations.api.guest.alert.getForAlerts.result.success')
    ]
];
