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
        'required' => __('validations.api.general.vatNumber.proof.getForVatNumberProofs.auth_ids.required'),
        'array'    => __('validations.api.general.vatNumber.proof.getForVatNumberProofs.auth_ids.array'),
        '*' => [
            'required' => 'The auth id field is required.',
            'integer'  => __('validations.api.general.vatNumber.proof.getForVatNumberProofs.auth_ids.*.integer')
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.vatNumber.proof.getForVatNumberProofs.result.success')
    ]
];
