<?php

namespace App\Http\Controllers\Api\General\Withdrawal\Interfaces;

use App\Http\Requests\Api\General\Withdrawal\Receipt\Proof\GetForWithdrawalReceiptProofsRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface WithdrawalReceiptProofControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Withdrawal\Interfaces
 */
interface WithdrawalReceiptProofControllerInterface
{
    /**
     * This method provides getting rows
     * by related entity repository
     *
     * @param string $withdrawalReceiptProofId
     *
     * @return JsonResponse
     */
    public function getForWithdrawalReceiptProof(
        string $withdrawalReceiptProofId
    ) : JsonResponse;

    /**
     * This method provides getting rows
     * by related entity repository
     *
     * @param GetForWithdrawalReceiptProofsRequest $request
     *
     * @return JsonResponse
     */
    public function getForWithdrawalReceiptProofs(
        GetForWithdrawalReceiptProofsRequest $request
    ) : JsonResponse;
}
