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

    'alert_images' => [
        'required' => __('validations.api.general.alert.image.storeMany.alert_images.required'),
        'array'    => __('validations.api.general.alert.image.storeMany.alert_images.array'),
        '*' => [
            'content' => [
                'required' => __('validations.api.general.alert.image.storeMany.alert_images.*.content.required'),
                'string'   => __('validations.api.general.alert.image.storeMany.alert_images.*.content.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.alert.image.storeMany.alert_images.*.extension.required'),
                'string'   => __('validations.api.general.alert.image.storeMany.alert_images.*.extension.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.alert.image.storeMany.alert_images.*.mime.required'),
                'string'   => __('validations.api.general.alert.image.storeMany.alert_images.*.mime.string')
            ]
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.alert.image.storeMany.result.success')
    ]
];
