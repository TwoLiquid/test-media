<?php

namespace App\Http\Controllers\Api\General\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\User\Interfaces\UserStickerControllerInterface;
use App\Http\Requests\Api\General\User\Sticker\DeleteFavoriteRequest;
use App\Http\Requests\Api\General\User\Sticker\GetByIdRequest;
use App\Http\Requests\Api\General\User\Sticker\GetByIdsRequest;
use App\Http\Requests\Api\General\User\Sticker\GetCategoriesRequest;
use App\Http\Requests\Api\General\User\Sticker\GetFeaturedRequest;
use App\Http\Requests\Api\General\User\Sticker\SearchByQueryRequest;
use App\Http\Requests\Api\General\User\Sticker\StoreFavoriteRequest;
use App\Repositories\User\UserFavoriteStickerRepository;
use App\Services\User\UserStickerService;
use App\Transformers\Api\General\User\Sticker\UserStickerCategoryTransformer;
use App\Transformers\Api\General\User\Sticker\UserStickerNextTransformer;
use App\Transformers\Api\General\User\Sticker\UserStickerTransformer;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

/**
 * Class UserStickerController
 *
 * @package App\Http\Controllers\Api\General\User
 */
final class UserStickerController extends BaseController implements UserStickerControllerInterface
{
    /**
     * @var UserFavoriteStickerRepository
     */
    protected UserFavoriteStickerRepository $userFavoriteStickerRepository;

    /**
     * @var UserStickerService
     */
    protected UserStickerService $userStickerService;

    /**
     * UserStickerController constructor
     */
    public function __construct()
    {
        /** @var UserFavoriteStickerRepository userFavoriteStickerRepository */
        $this->userFavoriteStickerRepository = new UserFavoriteStickerRepository();

        /** @var UserStickerService userStickerService */
        $this->userStickerService = new UserStickerService();

        parent::__construct();
    }

    /**
     * @param GetCategoriesRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws GuzzleException
     */
    public function getCategories(
        GetCategoriesRequest $request
    ) : JsonResponse
    {
        /**
         * Getting user sticker categories
         */
        $userStickerCategoriesCollection = $this->userStickerService->getCategories(
            $request->input('type')
        );

        return $this->respondWithSuccess(
            $this->transformCollection(
                $userStickerCategoriesCollection->categories,
                new UserStickerCategoryTransformer
            ), trans('validations/api/general/user/sticker/getCategories.result.success')
        );
    }

    /**
     * @param GetFeaturedRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws GuzzleException
     */
    public function getFeatured(
        GetFeaturedRequest $request
    ) : JsonResponse
    {
        /**
         * Getting user stickers
         */
        $userStickerCollection = $this->userStickerService->getFeatured(
            $request->input('limit'),
            $request->input('next')
        );

        return $this->respondWithSuccess(
            $this->transformCollection(
                $userStickerCollection->stickers,
                new UserStickerTransformer
            ) +
            $this->transformItem(
                $userStickerCollection,
                new UserStickerNextTransformer
            )['next'], trans('validations/api/general/user/sticker/getFeatured.result.success')
        );
    }

    /**
     * @param SearchByQueryRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws GuzzleException
     */
    public function searchByQuery(
        SearchByQueryRequest $request
    ) : JsonResponse
    {
        /**
         * Getting user stickers
         */
        $userStickerCollection = $this->userStickerService->searchByQuery(
            $request->input('query'),
            $request->input('limit'),
            $request->input('next')
        );

        return $this->respondWithSuccess(
            $this->transformCollection(
                $userStickerCollection->stickers,
                new UserStickerTransformer
            ) +
            $this->transformItem(
                $userStickerCollection,
                new UserStickerNextTransformer
            )['next'], trans('validations/api/general/user/sticker/searchByQuery.result.success')
        );
    }

    /**
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     * @throws GuzzleException
     */
    public function getFavorites() : JsonResponse
    {
        /**
         * Getting user favorite stickers
         */
        $userFavoriteStickers = $this->userFavoriteStickerRepository->getAllForUser(
            request()->input('auth_id')
        );

        /**
         * Getting user stickers
         */
        $userStickerCollection = $this->userStickerService->getFavorites(
            $userFavoriteStickers
        );

        return $this->respondWithSuccess(
            $this->transformCollection(
                $userStickerCollection->stickers,
                new UserStickerTransformer
            ) +
            $this->transformItem(
                $userStickerCollection,
                new UserStickerNextTransformer
            )['next'], trans('validations/api/general/user/sticker/getFavorites.result.success')
        );
    }

    /**
     * @param GetByIdRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws GuzzleException
     */
    public function getById(
        GetByIdRequest $request
    ) : JsonResponse
    {
        /**
         * Getting user stickers
         */
        $userStickerCollectionResponse = $this->userStickerService->getByIds([
            $request->input('sticker_id')
        ]);

        /**
         * Checking user stickers existence
         */
        if ($userStickerCollectionResponse->stickers->isEmpty()) {
            return $this->respondWithError(
                trans('validations/api/general/user/sticker/getById.result.error.exists')
            );
        }

        return $this->respondWithSuccess(
            $this->transformItem(
                $userStickerCollectionResponse->stickers->first(),
                new UserStickerTransformer
            ), trans('validations/api/general/user/sticker/getById.result.success')
        );
    }

    /**
     * @param GetByIdsRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws GuzzleException
     */
    public function getByIds(
        GetByIdsRequest $request
    ) : JsonResponse
    {
        /**
         * Getting user stickers
         */
        $userStickerCollection = $this->userStickerService->getByIds(
            $request->input('stickers_ids')
        );

        return $this->respondWithSuccess(
            $this->transformCollection(
                $userStickerCollection->stickers,
                new UserStickerTransformer
            ), trans('validations/api/general/user/sticker/getByIds.result.success')
        );
    }

    /**
     * @param StoreFavoriteRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function storeFavorite(
        StoreFavoriteRequest $request
    ) : JsonResponse
    {
        /**
         * Checking user favorite sticker existence
         */
        if ($this->userFavoriteStickerRepository->checkForUserExistence(
            $request->input('auth_id'),
            $request->input('external_id')
        )) {
            return $this->respondWithError(
                trans('validations/api/general/user/sticker/storeFavorite.result.error.exists')
            );
        }

        /**
         * Creating user favorite sticker
         */
        $this->userFavoriteStickerRepository->store(
            $request->input('auth_id'),
            $request->input('external_id')
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/sticker/storeFavorite.result.success')
        );
    }

    /**
     * @param DeleteFavoriteRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function deleteFavorite(
        DeleteFavoriteRequest $request
    ) : JsonResponse
    {
        /**
         * Checking user favorite sticker existence
         */
        if (!$this->userFavoriteStickerRepository->checkForUserExistence(
            $request->input('auth_id'),
            $request->input('external_id')
        )) {
            return $this->respondWithError(
                trans('validations/api/general/user/sticker/deleteFavorite.result.error.exists')
            );
        }

        /**
         * Deleting user favorite sticker
         */
        $this->userFavoriteStickerRepository->deleteForUser(
            $request->input('auth_id'),
            $request->input('external_id')
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/sticker/deleteFavorite.result.success')
        );
    }
}
