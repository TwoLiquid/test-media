<?php

namespace App\Http\Controllers\Api\General\User\Interfaces;

use App\Http\Requests\Api\General\User\Image\StoreManyRequest;
use App\Http\Requests\Api\General\User\Image\UpdateLikesRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface UserImageControllerInterface
 *
 * @package App\Http\Controllers\Api\General\User\Interfaces
 */
interface UserImageControllerInterface
{
    /**
     * This method provides storing single row
     * by related entity repository
     *
     * @param int $authId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     */
    public function storeMany(
        int $authId,
        StoreManyRequest $request
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

    /**
     * This method provides updating rows
     * by related entity repository
     *
     * @param int $id
     * @param UpdateLikesRequest $request
     *
     * @return JsonResponse
     */
    public function updateLikes(
        int $id,
        UpdateLikesRequest $request
    ) : JsonResponse;
}
