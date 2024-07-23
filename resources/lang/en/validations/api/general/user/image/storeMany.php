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

    'user_images' => [
        'required' => __('validations.api.general.user.image.storeMany.user_images.required'),
        'array'    => __('validations.api.general.user.image.storeMany.user_images.array'),
        '*' => [
            'request_id' => [
                'string' => __('validations.api.general.user.image.storeMany.user_images.*.request_id.string')
            ],
            'content' => [
                'required' => __('validations.api.general.user.image.storeMany.user_images.*.content.required'),
                'string'   => __('validations.api.general.user.image.storeMany.user_images.*.content.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.user.image.storeMany.user_images.*.mime.required'),
                'string'   => __('validations.api.general.user.image.storeMany.user_images.*.mime.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.user.image.storeMany.user_images.*.extension.required'),
                'string'   => __('validations.api.general.user.image.storeMany.user_images.*.extension.string')
            ]
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.user.image.storeMany.result.success')
    ]
];
