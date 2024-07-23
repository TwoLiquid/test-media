<?php

namespace App\Http\Controllers\Api\Guest\Platform\Interfaces;

use App\Http\Requests\Api\Guest\Platform\Icon\GetForPlatformsRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface PlatformIconControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\Platform\Interfaces
 */
interface PlatformIconControllerInterface
{
    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param int $platformId
     *
     * @return JsonResponse
     */
    public function getForPlatform(
        int $platformId
    ) : JsonResponse;

    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param GetForPlatformsRequest $request
     *
     * @return JsonResponse
     */
    public function getForPlatforms(
        GetForPlatformsRequest $request
    ) : JsonResponse;
}
