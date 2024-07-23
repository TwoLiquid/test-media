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
        'array' => __('validations.api.guest.user.getForUser.avatars_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUser.avatars_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUser.avatars_ids.*.integer')
        ]
    ],
    'voice_samples_ids' => [
        'array' => __('validations.api.guest.user.getForUser.voice_samples_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUser.voice_samples_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUser.voice_samples_ids.*.integer')
        ]
    ],
    'backgrounds_ids' => [
        'array' => __('validations.api.guest.user.getForUser.backgrounds_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUser.backgrounds_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUser.backgrounds_ids.*.integer')
        ]
    ],
    'images_ids' => [
        'array' => __('validations.api.guest.user.getForUser.images_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUser.images_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUser.images_ids.*.integer')
        ]
    ],
    'videos_ids' => [
        'array' => __('validations.api.guest.user.getForUser.videos_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUser.videos_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUser.videos_ids.*.integer')
        ]
    ],
    'vybe_images_ids' => [
        'array' => __('validations.api.guest.user.getForUser.vybe_images_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUser.vybe_images_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUser.vybe_images_ids.*.integer')
        ]
    ],
    'vybe_videos_ids' => [
        'array' => __('validations.api.guest.user.getForUser.vybe_videos_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUser.vybe_videos_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUser.vybe_videos_ids.*.integer')
        ]
    ],
    'activities_ids' => [
        'array' => __('validations.api.guest.user.getForUser.activities_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.user.getForUser.activities_ids.*.required'),
            'integer'  => __('validations.api.guest.user.getForUser.activities_ids.*.integer')
        ]
    ],
    'result' => [
        'success' => __('validations.api.guest.user.getForUser.result.success')
    ]
];
