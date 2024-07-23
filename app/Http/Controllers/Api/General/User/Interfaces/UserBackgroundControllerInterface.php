<?php

namespace App\Http\Controllers\Api\General\User\Interfaces;

use App\Http\Requests\Api\General\User\Background\StoreRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface UserBackgroundControllerInterface
 *
 * @package App\Http\Controllers\Api\General\User\Interfaces
 */
interface UserBackgroundControllerInterface
{
    /**
     * This method provides storing single row
     * by related entity repository
     *
     * @param int $authId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(
        int $authId,
        StoreRequest $request
    ) : JsonResponse;

    /**
     * This method provides updating row
     * by related entity repository
     *
     * @param string $requestId
     *
     * @return JsonResponse
     */
    public function acceptForRequest(
        string $requestId
    ) : JsonResponse;

    /**
     * This method provides updating row
     * by related entity repository
     *
     * @param string $requestId
     *
     * @return JsonResponse
     */
    public function declineForRequest(
        string $requestId
    ) : JsonResponse;
}
