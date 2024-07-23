<?php

namespace App\Http\Controllers\Api\General\VatNumber\Interfaces;

use App\Http\Requests\Api\General\VatNumber\Proof\Image\StoreManyRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface VatNumberProofImageControllerInterface
 *
 * @package App\Http\Controllers\Api\General\VatNumberProof\Interfaces
 */
interface VatNumberProofImageControllerInterface
{
    /**
     * This method provides storing rows
     * by related entity repository
     *
     * @param string $vatNumberProofId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     */
    public function storeMany(
        string $vatNumberProofId,
        StoreManyRequest $request
    ) : JsonResponse;
}
