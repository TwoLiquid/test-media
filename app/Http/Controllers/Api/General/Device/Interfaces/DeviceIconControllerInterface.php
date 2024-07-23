<?php

namespace App\Http\Controllers\Api\General\Device\Interfaces;

use App\Http\Requests\Api\General\Device\Icon\StoreRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface DeviceIconControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Device\Interfaces
 */
interface DeviceIconControllerInterface
{
    /**
     * This method provides storing single row
     * by related entity repository
     *
     * @param int $deviceId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(
        int $deviceId,
        StoreRequest $request
    ) : JsonResponse;

    /**
     * This method provides deleting rows
     * by related entity repository
     *
     * @param int $deviceId
     *
     * @return JsonResponse
     */
    public function destroy(
        int $deviceId
    ) : JsonResponse;
}
