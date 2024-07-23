<?php

namespace App\Http\Controllers\Api\General\Admin\Interfaces;

use App\Http\Requests\Api\General\Admin\Avatar\StoreRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface AdminAvatarControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Admin\Interfaces
 */
interface AdminAvatarControllerInterface
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
     * This method provides deleting rows
     * by related entity repository
     *
     * @param int $authId
     *
     * @return JsonResponse
     */
    public function destroy(
        int $authId
    ) : JsonResponse;
}
