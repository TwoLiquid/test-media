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

    'alert_sounds_ids' => [
        'required' => __('validations.api.general.alert.sound.destroyMany.alert_sounds_ids.required'),
        'array'    => __('validations.api.general.alert.sound.destroyMany.alert_sounds_ids.array'),
        '*' => [
            'required' => 'The alert sound id field is required.',
            'string'   => __('validations.api.general.alert.sound.destroyMany.alert_sounds_ids.*.string'),
            'exists'   => __('validations.api.general.alert.sound.destroyMany.alert_sounds_ids.*.exists')
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.alert.sound.destroyMany.result.success')
    ]
];
