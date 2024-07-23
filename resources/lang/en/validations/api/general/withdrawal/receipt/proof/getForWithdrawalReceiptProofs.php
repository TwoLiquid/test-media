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

    'withdrawal_receipts_ids' => [
        'required' => __('validations.api.general.withdrawal.receipt.proof.getForWithdrawalReceiptProofs.withdrawal_receipts_ids.required'),
        'array'    => __('validations.api.general.withdrawal.receipt.proof.getForWithdrawalReceiptProofs.withdrawal_receipts_ids.array'),
        '*' => [
            'required' => 'The withdrawal receipt id field is required.',
            'integer'  => __('validations.api.general.withdrawal.receipt.proof.getForWithdrawalReceiptProofs.withdrawal_receipts_ids.*.integer')
        ]
    ],
    'result' => [
        'success' => __('validations.api.general.withdrawal.receipt.proof.getForWithdrawalReceiptProofs.result.success')
    ]
];
