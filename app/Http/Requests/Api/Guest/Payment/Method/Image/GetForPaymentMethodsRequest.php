<?php

namespace App\Http\Requests\Api\Guest\Payment\Method\Image;

use App\Http\Requests\Api\BaseRequest;

/**
 * Class GetForPaymentMethodsRequest
 *
 * @package App\Http\Requests\Api\Guest\Payment\Method\Image
 */
class GetForPaymentMethodsRequest extends BaseRequest
{
    /**
     * @return array
     */
    public function rules() : array
    {
        return [
            'payment_methods_ids'   => 'required|array',
            'payment_methods_ids.*' => 'required|integer'
        ];
    }

    /**
     * @return array
     */
    public function messages() : array
    {
        return [
            'payment_methods_ids.required'   => trans('validations/api/guest/payment/method/image/getForPaymentMethods.payment_methods_ids.required'),
            'payment_methods_ids.array'      => trans('validations/api/guest/payment/method/image/getForPaymentMethods.payment_methods_ids.array'),
            'payment_methods_ids.*.required' => trans('validations/api/guest/payment/method/image/getForPaymentMethods.payment_methods_ids.*.required'),
            'payment_methods_ids.*.integer'  => trans('validations/api/guest/payment/method/image/getForPaymentMethods.payment_methods_ids.*.integer')
        ];
    }
}
