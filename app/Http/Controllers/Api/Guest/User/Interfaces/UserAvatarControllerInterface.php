<?php

namespace App\Http\Controllers\Api\Guest\User\Interfaces;

use App\Http\Requests\Api\Guest\User\Avatar\GetForUsersRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface UserAvatarControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\User\Interfaces
 */
interface UserAvatarControllerInterface
{
    /**
     * @param GetForUsersRequest $request
     *
     * @return JsonResponse
     */
    public function getForUsers(
        GetForUsersRequest $request
    ) : JsonResponse;
}
