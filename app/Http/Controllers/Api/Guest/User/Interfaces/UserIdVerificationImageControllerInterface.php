<?php

namespace App\Http\Controllers\Api\Guest\User\Interfaces;

use Illuminate\Http\JsonResponse;

/**
 * Interface UserIdVerificationImageControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\User\Interfaces
 */
interface UserIdVerificationImageControllerInterface
{
    /**
     * This method provides getting rows
     * by related entity repository
     *
     * @param int $authId
     * @return JsonResponse
     */
    public function getForUser(
        int $authId
    ) : JsonResponse;

    /**
     * This method provides getting rows
     * by related entity repository
     *
     * @param string $requestId
     *
     * @return JsonResponse
     */
    public function getForRequest(
        string $requestId
    ) : JsonResponse;
}
