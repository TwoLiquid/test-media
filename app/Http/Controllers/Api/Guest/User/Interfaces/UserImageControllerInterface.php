<?php

namespace App\Http\Controllers\Api\Guest\User\Interfaces;

use Illuminate\Http\JsonResponse;

/**
 * Interface UserImageControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\User\Interfaces
 */
interface UserImageControllerInterface
{
    /**
     * This method provides checking single row
     * by related entity repository
     *
     * @param int $authId
     * @param int $id
     *
     * @return JsonResponse
     */
    public function existsForUser(
        int $authId,
        int $id
    ) : JsonResponse;
}
