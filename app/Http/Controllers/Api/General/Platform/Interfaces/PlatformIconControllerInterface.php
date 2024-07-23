<?php

namespace App\Http\Controllers\Api\General\Platform\Interfaces;

use App\Http\Requests\Api\General\Platform\Icon\StoreRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface PlatformIconControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Platform\Interfaces
 */
interface PlatformIconControllerInterface
{
    /**
     * This method provides storing single row
     * by related entity repository
     *
     * @param int $platformId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(
        int $platformId,
        StoreRequest $request
    ) : JsonResponse;

    /**
     * This method provides deleting rows
     * by related entity repository
     *
     * @param int $platformId
     *
     * @return JsonResponse
     */
    public function destroy(
        int $platformId
    ) : JsonResponse;
}
