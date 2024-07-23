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

    'user_videos' => [
        'required' => __('validations.api.general.user.video.storeMany.user_videos.required'),
        'array'    => __('validations.api.general.user.video.storeMany.user_videos.array'),
        '*' => [
            'request_id' => [
                'string' => __('validations.api.general.user.video.storeMany.user_videos.*.request_id.string')
            ],
            'content' => [
                'required' => __('validations.api.general.user.video.storeMany.user_videos.*.content.required'),
                'string'   => __('validations.api.general.user.video.storeMany.user_videos.*.content.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.user.video.storeMany.user_videos.*.mime.required'),
                'string'   => __('validations.api.general.user.video.storeMany.user_videos.*.mime.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.user.video.storeMany.user_videos.*.extension.required'),
                'string'   => __('validations.api.general.user.video.storeMany.user_videos.*.extension.string')
            ]
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.user.video.storeMany.result.success')
    ]
];
