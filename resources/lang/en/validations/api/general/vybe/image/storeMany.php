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

    'vybe_images' => [
        'required' => __('validations.api.general.vybe.image.storeMany.vybe_images.required'),
        'array'    => __('validations.api.general.vybe.image.storeMany.vybe_images.array'),
        '*' => [
            'content' => [
                'required' => __('validations.api.general.vybe.image.storeMany.vybe_images.*.content.required'),
                'string'   => __('validations.api.general.vybe.image.storeMany.vybe_images.*.content.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.vybe.image.storeMany.vybe_images.*.mime.required'),
                'string'   => __('validations.api.general.vybe.image.storeMany.vybe_images.*.mime.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.vybe.image.storeMany.vybe_images.*.extension.required'),
                'string'   => __('validations.api.general.vybe.image.storeMany.vybe_images.*.extension.string')
            ],
            'main' => [
                'boolean' => __('validations.api.general.vybe.image.storeMany.vybe_images.*.main.boolean')
            ],
            'declined' => [
                'boolean' => __('validations.api.general.vybe.image.storeMany.vybe_images.*.declined.boolean')
            ]
        ]
    ],
    'result' => [
        'error' => [
            'find' => __('validations.api.general.vybe.image.storeMany.result.error.find')
        ],
        'success' => __('validations.api.general.vybe.image.storeMany.result.success')
    ]
];
