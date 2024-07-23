<?php

namespace App\Http\Controllers\Api\Guest\Alert\Interfaces;

use App\Http\Requests\Api\Guest\Alert\GetForAlertsRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface AlertControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\Alert\Interfaces
 */
interface AlertControllerInterface
{
    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param int $alertId
     *
     * @return JsonResponse
     */
    public function getForAlert(
        int $alertId
    ) : JsonResponse;

    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param GetForAlertsRequest $request
     *
     * @return JsonResponse
     */
    public function getForAlerts(
        GetForAlertsRequest $request
    ) : JsonResponse;
}
