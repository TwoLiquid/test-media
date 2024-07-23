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

    'platforms_ids' => [
        'required' => __('validations.api.guest.platform.icon.getForPlatforms.platforms_ids.required'),
        'array'    => __('validations.api.guest.platform.icon.getForPlatforms.platforms_ids.array'),
        '*' => [
            'required' => 'The platform id field is required.',
            'string'   => __('validations.api.guest.platform.icon.getForPlatforms.platforms_ids.*.string'),
            'exists'   => __('validations.api.guest.platform.icon.getForPlatforms.platforms_ids.*.exists')
        ]
    ],
    'result' => [
        'success' => __('validations.api.guest.platform.icon.getForPlatforms.result.success')
    ]
];
