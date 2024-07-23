<?php

namespace App\Http\Controllers\Api\General\VatNumber\Interfaces;

use App\Http\Requests\Api\General\VatNumber\Proof\GetForVatNumberProofsRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface VatNumberProofControllerInterface
 *
 * @package App\Http\Controllers\Api\General\VatNumberProof\Interfaces
 */
interface VatNumberProofControllerInterface
{
    /**
     * This method provides getting rows
     * by related entity repository
     *
     * @param string $vatNumberProofId
     *
     * @return JsonResponse
     */
    public function getForVatNumberProof(
        string $vatNumberProofId
    ) : JsonResponse;

    /**
     * This method provides getting rows
     * by related entity repository
     *
     * @param GetForVatNumberProofsRequest $request
     *
     * @return JsonResponse
     */
    public function getForVatNumberProofs(
        GetForVatNumberProofsRequest $request
    ) : JsonResponse;
}
