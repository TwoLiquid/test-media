<?php

namespace App\Http\Controllers\Api\General\User\Interfaces;

use App\Http\Requests\Api\General\User\IdVerification\Image\StoreRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface UserIdVerificationImageControllerInterface
 *
 * @package App\Http\Controllers\Api\General\User\Interfaces
 */
interface UserIdVerificationImageControllerInterface
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
     * This method provides updating rows
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
