<?php

namespace App\Http\Controllers\Api\General\User\Interfaces;

use App\Http\Requests\Api\General\User\Sticker\DeleteFavoriteRequest;
use App\Http\Requests\Api\General\User\Sticker\GetByIdRequest;
use App\Http\Requests\Api\General\User\Sticker\GetByIdsRequest;
use App\Http\Requests\Api\General\User\Sticker\GetCategoriesRequest;
use App\Http\Requests\Api\General\User\Sticker\GetFeaturedRequest;
use App\Http\Requests\Api\General\User\Sticker\SearchByQueryRequest;
use App\Http\Requests\Api\General\User\Sticker\StoreFavoriteRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface UserStickerControllerInterface
 *
 * @package App\Http\Controllers\Api\General\User\Interfaces
 */
interface UserStickerControllerInterface
{
    /**
     * This method provides getting rows
     * by related entity repository
     *
     * @param GetCategoriesRequest $request
     *
     * @return JsonResponse
     */
    public function getCategories(
        GetCategoriesRequest $request
    ) : JsonResponse;

    /**
     * This method provides getting rows
     * by related entity repository
     *
     * @param GetFeaturedRequest $request
     *
     * @return JsonResponse
     */
    public function getFeatured(
        GetFeaturedRequest $request
    ) : JsonResponse;

    /**
     * This method provides getting rows
     * by related entity repository
     *
     * @param SearchByQueryRequest $request
     *
     * @return JsonResponse
     */
    public function searchByQuery(
        SearchByQueryRequest $request
    ) : JsonResponse;

    /**
     * This method provides getting rows
     * by related entity repository
     *
     * @return JsonResponse
     */
    public function getFavorites() : JsonResponse;

    /**
     * This method provides getting row
     * by related entity repository
     *
     * @param GetByIdRequest $request
     *
     * @return JsonResponse
     */
    public function getById(
        GetByIdRequest $request
    ) : JsonResponse;

    /**
     * This method provides getting rows
     * by related entity repository
     *
     * @param GetByIdsRequest $request
     *
     * @return JsonResponse
     */
    public function getByIds(
        GetByIdsRequest $request
    ) : JsonResponse;

    /**
     * This method provides storing single row
     * by related entity repository
     *
     * @param StoreFavoriteRequest $request
     *
     * @return JsonResponse
     */
    public function storeFavorite(
        StoreFavoriteRequest $request
    ) : JsonResponse;

    /**
     * This method provides deleting single row
     * by related entity repository
     *
     * @param DeleteFavoriteRequest $request
     *
     * @return JsonResponse
     */
    public function deleteFavorite(
        DeleteFavoriteRequest $request
    ) : JsonResponse;
}
