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

    'alert_images_ids' => [
        'required' => __('validations.api.general.alert.image.destroyMany.alert_images_ids.required'),
        'array'    => __('validations.api.general.alert.image.destroyMany.alert_images_ids.array'),
        '*' => [
            'required' => 'The alert image id field is required.',
            'string'   => __('validations.api.general.alert.image.destroyMany.alert_images_ids.*.string'),
            'exists'   => __('validations.api.general.alert.image.destroyMany.alert_images_ids.*.exists')
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.alert.image.destroyMany.result.success')
    ]
];
