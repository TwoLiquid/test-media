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

    'avatars_ids' => [
        'array' => __('validations.api.guest.user.getForUsers.avatars_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUsers.avatars_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUsers.avatars_ids.*.integer')
        ]
    ],
    'voice_samples_ids' => [
        'array' => __('validations.api.guest.user.getForUsers.voice_samples_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUsers.voice_samples_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUsers.voice_samples_ids.*.integer')
        ]
    ],
    'backgrounds_ids' => [
        'array' => __('validations.api.guest.user.getForUsers.backgrounds_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUsers.backgrounds_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUsers.backgrounds_ids.*.integer')
        ]
    ],
    'images_ids' => [
        'array' => __('validations.api.guest.user.getForUsers.images_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUsers.images_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUsers.images_ids.*.integer')
        ]
    ],
    'videos_ids' => [
        'array' => __('validations.api.guest.user.getForUsers.videos_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUsers.videos_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUsers.videos_ids.*.integer')
        ]
    ],
    'vybe_images_ids' => [
        'array' => __('validations.api.guest.user.getForUsers.vybe_images_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUsers.vybe_images_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUsers.vybe_images_ids.*.integer')
        ]
    ],
    'vybe_videos_ids' => [
        'array' => __('validations.api.guest.user.getForUsers.vybe_videos_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUsers.vybe_videos_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUsers.vybe_videos_ids.*.integer')
        ]
    ],
    'activities_ids' => [
        'array' => __('validations.api.guest.user.getForUsers.activities_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUsers.activities_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUsers.activities_ids.*.integer')
        ]
    ],
    'result' => [
        'success' => __('validations.api.guest.user.getForUsers.result.success')
    ]
];
