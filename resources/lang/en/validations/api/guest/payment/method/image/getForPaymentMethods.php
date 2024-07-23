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

    'payment_methods_ids' => [
        'required' => __('validations.api.guest.payment.method.image.getForPaymentMethods.payment_methods_ids.required'),
        'array'    => __('validations.api.guest.payment.method.image.getForPaymentMethods.payment_methods_ids.array'),
        '*' => [
            'required' => 'The payment method id field is required.',
            'string'   => __('validations.api.guest.payment.method.image.getForPaymentMethods.payment_methods_ids.*.string'),
            'exists'   => __('validations.api.guest.payment.method.image.getForPaymentMethods.payment_methods_ids.*.exists')
        ]
    ],
    'result' => [
        'success' => __('validations.api.guest.payment.method.image.getForPaymentMethods.result.success')
    ]
];
