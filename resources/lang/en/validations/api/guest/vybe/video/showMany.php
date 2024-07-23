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

    'vybe_videos_ids' => [
        'required' => __('validations.api.guest.vybe.video.showMany.vybe_videos_ids.required'),
        'array'    => __('validations.api.guest.vybe.video.showMany.vybe_videos_ids.array'),
        '*' => [
            'required' => 'The vybe video id field is required.',
            'string'   => __('validations.api.guest.vybe.video.showMany.vybe_videos_ids.*.string'),
            'exists'   => __('validations.api.guest.vybe.video.showMany.vybe_videos_ids.*.exists')
        ]
    ],
    'result' => [
        'success' => __('validations.api.guest.vybe.video.showMany.result.success')
    ]
];
