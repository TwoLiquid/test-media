<?php

namespace App\Http\Controllers\Api\General\Withdrawal\Interfaces;

use App\Http\Requests\Api\General\Withdrawal\Receipt\Proof\Document\StoreManyRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface WithdrawalReceiptProofDocumentControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Withdrawal\Interfaces
 */
interface WithdrawalReceiptProofDocumentControllerInterface
{
    /**
     * This method provides storing rows
     * by related entity repository
     *
     * @param string $withdrawalReceiptProofId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     */
    public function storeMany(
        string $withdrawalReceiptProofId,
        StoreManyRequest $request
    ) : JsonResponse;
}
