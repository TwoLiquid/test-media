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

    'alert_sounds' => [
        'required' => __('validations.api.general.alert.sound.storeMany.alert_sounds.required'),
        'array'    => __('validations.api.general.alert.sound.storeMany.alert_sounds.array'),
        '*' => [
            'content' => [
                'required' => __('validations.api.general.alert.sound.storeMany.alert_sounds.*.content.required'),
                'string'   => __('validations.api.general.alert.sound.storeMany.alert_sounds.*.content.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.alert.sound.storeMany.alert_sounds.*.extension.required'),
                'string'   => __('validations.api.general.alert.sound.storeMany.alert_sounds.*.extension.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.alert.sound.storeMany.alert_sounds.*.mime.required'),
                'string'   => __('validations.api.general.alert.sound.storeMany.alert_sounds.*.mime.string')
            ]
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.alert.sound.storeMany.result.success')
    ]
];
