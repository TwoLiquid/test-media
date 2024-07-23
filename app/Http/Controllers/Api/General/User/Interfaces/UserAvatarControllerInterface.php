<?php

namespace App\Http\Controllers\Api\General\User\Interfaces;

use App\Http\Requests\Api\General\User\Avatar\StoreRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface UserAvatarControllerInterface
 *
 * @package App\Http\Controllers\Api\General\User\Interfaces
 */
interface UserAvatarControllerInterface
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
