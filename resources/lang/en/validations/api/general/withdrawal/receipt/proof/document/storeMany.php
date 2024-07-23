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

    'withdrawal_receipt_proof_documents' => [
        'required' => __('validations.api.general.withdrawal.receipt.proof.document.storeMany.withdrawal_receipt_proof_documents.required'),
        'array'    => __('validations.api.general.withdrawal.receipt.proof.document.storeMany.withdrawal_receipt_proof_documents.array'),
        '*' => [
            'content' => [
                'required' => __('validations.api.general.withdrawal.receipt.proof.document.storeMany.withdrawal_receipt_proof_documents.*.content.required'),
                'string'   => __('validations.api.general.withdrawal.receipt.proof.document.storeMany.withdrawal_receipt_proof_documents.*.content.string')
            ],
            'mime' => [
                'required' => __('validations.api.general.withdrawal.receipt.proof.document.storeMany.withdrawal_receipt_proof_documents.*.mime.required'),
                'string'   => __('validations.api.general.withdrawal.receipt.proof.document.storeMany.withdrawal_receipt_proof_documents.*.mime.string')
            ],
            'extension' => [
                'required' => __('validations.api.general.withdrawal.receipt.proof.document.storeMany.withdrawal_receipt_proof_documents.*.extension.required'),
                'string'   => __('validations.api.general.withdrawal.receipt.proof.document.storeMany.withdrawal_receipt_proof_documents.*.extension.string')
            ]
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.withdrawal.receipt.proof.document.storeMany.result.success')
    ]
];
