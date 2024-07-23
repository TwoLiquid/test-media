<?php

namespace App\Http\Controllers\Api\General\Category;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Category\Interfaces\CategoryIconControllerInterface;
use App\Http\Requests\Api\General\Category\Icon\StoreRequest;
use App\Repositories\Category\CategoryIconRepository;
use App\Services\Category\CategoryIconService;
use App\Transformers\Api\General\Category\CategoryIconTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class CategoryIconController
 *
 * @package App\Http\Controllers\Api\General\Category
 */
final class CategoryIconController extends BaseController implements CategoryIconControllerInterface
{
    /**
     * @var CategoryIconRepository
     */
    protected CategoryIconRepository $categoryIconRepository;

    /**
     * @var CategoryIconService
     */
    protected CategoryIconService $categoryIconService;

    /**
     * CategoryIconController constructor
     */
    public function __construct()
    {
        /** @var CategoryIconRepository categoryIconRepository */
        $this->categoryIconRepository = new CategoryIconRepository();

        /** @var CategoryIconService categoryIconService */
        $this->categoryIconService = new CategoryIconService();

        parent::__construct();
    }

    /**
     * @param int $categoryId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function store(
        int $categoryId,
        StoreRequest $request
    ) : JsonResponse
    {
        /**
         * Creating category icon
         */
        $categoryIcon = $this->categoryIconService->createIcon(
            $categoryId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($categoryIcon, new CategoryIconTransformer),
            trans('validations/api/general/category/icon/store.result.success')
        );
    }

    /**
     * @param int $categoryId
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function destroy(
        int $categoryId
    ) : JsonResponse
    {
        /**
         * Getting category icons
         */
        $categoryIcons = $this->categoryIconRepository->getForCategory(
            $categoryId
        );

        /**
         * Deleting category icons
         */
        $this->categoryIconService->deleteIcons(
            $categoryIcons
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/category/icon/destroy.result.success')
        );
    }
}
