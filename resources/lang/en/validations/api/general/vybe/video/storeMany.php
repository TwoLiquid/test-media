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

    'vybe_videos' => [
        'required' => __('validations.api.general.vybe.video.storeMany.vybe_videos.required'),
        'array'    => __('validations.api.general.vybe.video.storeMany.vybe_videos.array'),
        '*' => [
            'content' => [
                'required' => __('validations.api.general.vybe.video.storeMany.vybe_videos.*.content.required'),
                'string'   => __('validations.api.general.vybe.video.storeMany.vybe_videos.*.content.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.vybe.video.storeMany.vybe_videos.*.mime.required'),
                'string'   => __('validations.api.general.vybe.video.storeMany.vybe_videos.*.mime.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.vybe.video.storeMany.vybe_videos.*.extension.required'),
                'string'   => __('validations.api.general.vybe.video.storeMany.vybe_videos.*.extension.string')
            ],
            'main' => [
                'boolean' => __('validations.api.general.vybe.video.storeMany.vybe_videos.*.main.boolean')
            ],
            'declined' => [
                'boolean' => __('validations.api.general.vybe.video.storeMany.vybe_videos.*.declined.boolean')
            ]
        ]
    ],
    'result' => [
        'error' => [
            'find' => __('validations.api.general.vybe.video.storeMany.result.error.find')
        ],
        'success' => __('validations.api.general.vybe.video.storeMany.result.success')
    ]
];
