<?php

namespace App\Http\Controllers\Api\Guest\Device\Interfaces;

use App\Http\Requests\Api\Guest\Device\Icon\GetForDevicesRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface DeviceIconControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\Device\Interfaces
 */
interface DeviceIconControllerInterface
{
    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param int $deviceId
     *
     * @return JsonResponse
     */
    public function getForDevice(
        int $deviceId
    ) : JsonResponse;

    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param GetForDevicesRequest $request
     *
     * @return JsonResponse
     */
    public function getForDevices(
        GetForDevicesRequest $request
    ) : JsonResponse;
}
