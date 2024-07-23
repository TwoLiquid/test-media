<?php

namespace App\Http\Controllers\Api\General\Activity\Interfaces;

use App\Http\Requests\Api\General\Activity\Image\StoreManyRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface ActivityImageControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Activity\Interfaces
 */
interface ActivityImageControllerInterface
{
    /**
     * This method provides storing rows
     * by related entity repository
     *
     * @param int $activityId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     */
    public function storeMany(
        int $activityId,
        StoreManyRequest $request
    ) : JsonResponse;

    /**
     * This method provides deleting rows
     * by related entity repository
     *
     * @param int $activityId
     *
     * @return JsonResponse
     */
    public function destroy(
        int $activityId
    ) : JsonResponse;
}
