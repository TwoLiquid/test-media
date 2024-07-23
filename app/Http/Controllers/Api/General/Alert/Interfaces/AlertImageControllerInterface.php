<?php

namespace App\Http\Controllers\Api\General\Alert\Interfaces;

use App\Http\Requests\Api\General\Alert\Image\DestroyManyRequest;
use App\Http\Requests\Api\General\Alert\Image\StoreManyRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface AlertImageControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Alert\Interfaces
 */
interface AlertImageControllerInterface
{
    /**
     * This method provides storing rows
     * by related entity repository
     *
     * @param int $alertId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     */
    public function storeMany(
        int $alertId,
        StoreManyRequest $request
    ) : JsonResponse;

    /**
     * This method provides deleting rows
     * by related entity repository
     *
     * @param DestroyManyRequest $request
     *
     * @return JsonResponse
     */
    public function destroyMany(
        DestroyManyRequest $request
    ) : JsonResponse;
}
