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

    'activities_ids' => [
        'array' => __('validations.api.guest.activity.image.getForActivities.activities_ids.array'),
        '*' => [
            'required' => __('validations.api.guest.activity.image.getForActivities.activities_ids.*.required'),
            'integer'  => __('validations.api.guest.activity.image.getForActivities.activities_ids.*.integer')
        ]
    ],
    'result' => [
        'success' => __('validations.api.guest.activity.image.getForActivities.result.success')
    ]
];
