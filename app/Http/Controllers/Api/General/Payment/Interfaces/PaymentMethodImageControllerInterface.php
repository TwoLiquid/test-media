<?php

namespace App\Http\Controllers\Api\General\Payment\Interfaces;

use App\Http\Requests\Api\General\Payment\Method\Image\StoreRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface PaymentMethodImageControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Payment\Interfaces
 */
interface PaymentMethodImageControllerInterface
{
    /**
     * This method provides storing single row
     * by related entity repository
     *
     * @param int $paymentMethodId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(
        int $paymentMethodId,
        StoreRequest $request
    ) : JsonResponse;

    /**
     * This method provides deleting rows
     * by related entity repository
     *
     * @param int $paymentMethodId
     *
     * @return JsonResponse
     */
    public function destroy(
        int $paymentMethodId
    ) : JsonResponse;
}
