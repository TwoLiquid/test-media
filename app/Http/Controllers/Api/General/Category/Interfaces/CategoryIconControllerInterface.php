<?php

namespace App\Http\Controllers\Api\General\Category\Interfaces;

use App\Http\Requests\Api\General\Category\Icon\StoreRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface CategoryIconControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\Category\Interfaces
 */
interface CategoryIconControllerInterface
{
    /**
     * This method provides storing single row
     * by related entity repository
     *
     * @param int $categoryId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(
        int $categoryId,
        StoreRequest $request
    ) : JsonResponse;

    /**
     * This method provides deleting rows
     * by related entity repository
     *
     * @param int $categoryId
     *
     * @return JsonResponse
     */
    public function destroy(
        int $categoryId
    ) : JsonResponse;
}
