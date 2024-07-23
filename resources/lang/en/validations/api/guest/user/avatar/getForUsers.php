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
        'required' => __('validations.api.guest.user.avatar.getForUsers.auth_ids.required'),
        'array'    => __('validations.api.guest.user.avatar.getForUsers.auth_ids.array'),
        '*' => [
            'required' => 'The auth id field is required.',
            'integer'  => __('validations.api.guest.user.avatar.getForUsers.auth_ids.*.integer')
        ]
    ],
    'result' => [
        'success' => __('validations.api.guest.user.avatar.getForUsers.result.success')
    ]
];
