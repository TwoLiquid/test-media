<?php

namespace App\Http\Controllers\Api\Guest\Activity\Interfaces;

use App\Http\Requests\Api\Guest\Activity\GetForActivitiesRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface ActivityControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\Activity\Interfaces
 */
interface ActivityControllerInterface
{
    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param int $activityId
     *
     * @return JsonResponse
     */
    public function getForActivity(
        int $activityId
    ) : JsonResponse;

    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param GetForActivitiesRequest $request
     *
     * @return JsonResponse
     */
    public function getForActivities(
        GetForActivitiesRequest $request
    ) : JsonResponse;
}
