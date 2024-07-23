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

    'vybe_images_ids' => [
        'required' => __('validations.api.general.vybe.image.destroyMany.vybe_images_ids.required'),
        'array'    => __('validations.api.general.vybe.image.destroyMany.vybe_images_ids.array'),
        '*' => [
            'required' => 'The vybe image id field is required.',
            'string'   => __('validations.api.general.vybe.image.destroyMany.vybe_images_ids.*.string'),
            'exists'   => __('validations.api.general.vybe.image.destroyMany.vybe_images_ids.*.exists')
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.vybe.image.destroyMany.result.success')
    ]
];
