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

    'activity_images' => [
        'required' => __('validations.api.general.activity.image.storeMany.activity_images.required'),
        'array'    => __('validations.api.general.activity.image.storeMany.activity_images.array'),
        '*' => [
            'content' => [
                'required' => __('validations.api.general.activity.image.storeMany.activity_images.*.content.required'),
                'string'   => __('validations.api.general.activity.image.storeMany.activity_images.*.content.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.activity.image.storeMany.activity_images.*.mime.required'),
                'string'   => __('validations.api.general.activity.image.storeMany.activity_images.*.mime.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.activity.image.storeMany.activity_images.*.extension.required'),
                'string'   => __('validations.api.general.activity.image.storeMany.activity_images.*.extension.string')
            ],
            'type' => [
                'required' => __('validations.api.general.activity.image.storeMany.activity_images.*.type.required'),
                'string'   => __('validations.api.general.activity.image.storeMany.activity_images.*.type.string')
            ]
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.activity.image.storeMany.result.success')
    ]
];
