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

    'vat_number_proof_images' => [
        'required' => __('validations.api.general.vatNumber.proof.image.storeMany.vat_number_proof_images.required'),
        'array'    => __('validations.api.general.vatNumber.proof.image.storeMany.vat_number_proof_images.array'),
        '*' => [
            'content' => [
                'required' => __('validations.api.general.vatNumber.proof.image.storeMany.vat_number_proof_images.*.content.required'),
                'string'   => __('validations.api.general.vatNumber.proof.image.storeMany.vat_number_proof_images.*.content.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.vatNumber.proof.image.storeMany.vat_number_proof_images.*.mime.required'),
                'string'   => __('validations.api.general.vatNumber.proof.image.storeMany.vat_number_proof_images.*.mime.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.vatNumber.proof.image.storeMany.vat_number_proof_images.*.extension.required'),
                'string'   => __('validations.api.general.vatNumber.proof.image.storeMany.vat_number_proof_images.*.extension.string')
            ]
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.vatNumber.proof.image.storeMany.result.success')
    ]
];
