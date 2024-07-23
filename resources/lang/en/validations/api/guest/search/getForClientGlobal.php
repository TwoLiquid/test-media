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

    'auth_ids' => [
        'array' => __('validations.api.guest.search.getForClientGlobal.auth_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.search.getForClientGlobal.auth_ids.*.required'),
            'integer'  => __('validations.api.guest.search.getForClientGlobal.auth_ids.*.integer')
        ]
    ],
    'vybe_images_ids' => [
        'array' => __('validations.api.guest.search.getForClientGlobal.vybe_images_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.search.getForClientGlobal.vybe_images_ids.*.required'),
            'integer'  => __('validations.api.guest.search.getForClientGlobal.vybe_images_ids.*.integer')
        ]
    ],
    'vybe_videos_ids' => [
        'array' => __('validations.api.guest.search.getForClientGlobal.vybe_videos_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.search.getForClientGlobal.vybe_videos_ids.*.required'),
            'integer'  => __('validations.api.guest.search.getForClientGlobal.vybe_videos_ids.*.integer')
        ]
    ],
    'activities_ids' => [
        'array' => __('validations.api.guest.search.getForClientGlobal.activities_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.search.getForClientGlobal.activities_ids.*.required'),
            'integer'  => __('validations.api.guest.search.getForClientGlobal.activities_ids.*.integer')
        ]
    ],
    'result' => [
        'success' => __('validations.api.guest.search.getForClientGlobal.result.success')
    ]
];
