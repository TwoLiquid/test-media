<?php

namespace App\Http\Controllers\Api\Guest\User\Interfaces;

use App\Http\Requests\Api\Guest\User\GetForUserRequest;
use App\Http\Requests\Api\Guest\User\GetForUsersRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface UserControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\User\Interfaces
 */
interface UserControllerInterface
{
    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param int $authId
     * @param GetForUserRequest $request
     *
     * @return JsonResponse
     */
    public function getForUser(
        int $authId,
        GetForUserRequest $request
    ) : JsonResponse;

    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param GetForUsersRequest $request
     *
     * @return JsonResponse
     */
    public function getForUsers(
        GetForUsersRequest $request
    ) : JsonResponse;

    /**
     * This method provides getting all rows
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
