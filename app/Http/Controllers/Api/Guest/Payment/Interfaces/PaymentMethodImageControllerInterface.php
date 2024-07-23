<?php

namespace App\Http\Controllers\Api\Guest\Payment\Interfaces;

use App\Http\Requests\Api\Guest\Payment\Method\Image\GetForPaymentMethodsRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface PaymentMethodImageControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\Payment\Interfaces
 */
interface PaymentMethodImageControllerInterface
{
    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param int $paymentMethodId
     *
     * @return JsonResponse
     */
    public function getForPaymentMethod(
        int $paymentMethodId
    ) : JsonResponse;

    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param GetForPaymentMethodsRequest $request
     *
     * @return JsonResponse
     */
    public function getForPaymentMethods(
        GetForPaymentMethodsRequest $request
    ) : JsonResponse;
}
