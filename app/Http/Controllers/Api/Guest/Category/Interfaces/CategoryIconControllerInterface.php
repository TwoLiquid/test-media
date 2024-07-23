<?php

namespace App\Http\Controllers\Api\Guest\Category\Interfaces;

use App\Http\Requests\Api\Guest\Category\Icon\GetForCategoriesRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface CategoryIconControllerInterface
 *
 * @package App\Http\Controllers\Api\Guest\Category\Interfaces
 */
interface CategoryIconControllerInterface
{
    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param int $categoryId
     *
     * @return JsonResponse
     */
    public function getForCategory(
        int $categoryId
    ) : JsonResponse;

    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param GetForCategoriesRequest $request
     *
     * @return JsonResponse
     */
    public function getForCategories(
        GetForCategoriesRequest $request
    ) : JsonResponse;
}
