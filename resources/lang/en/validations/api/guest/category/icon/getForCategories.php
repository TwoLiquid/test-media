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

    'categories_ids' => [
        'required' => __('validations.api.guest.category.icon.getForCategories.categories_ids.required'),
        'array'    => __('validations.api.guest.category.icon.getForCategories.categories_ids.array'),
        '*' => [
            'required' => 'The category id field is required.',
            'string'   => __('validations.api.guest.category.icon.getForCategories.categories_ids.*.string'),
            'exists'   => __('validations.api.guest.category.icon.getForCategories.categories_ids.*.exists')
        ]
    ],
    'result' => [
        'success' => __('validations.api.guest.category.icon.getForCategories.result.success')
    ]
];
