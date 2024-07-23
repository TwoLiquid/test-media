<?php

namespace App\Http\Controllers\Api\Guest\Category;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\Category\Interfaces\CategoryIconControllerInterface;
use App\Http\Requests\Api\Guest\Category\Icon\GetForCategoriesRequest;
use App\Repositories\Category\CategoryIconRepository;
use App\Services\Category\CategoryIconService;
use App\Transformers\Api\Guest\Category\CategoryIconTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class CategoryIconController
 *
 * @package App\Http\Controllers\Api\Guest\Category
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
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForCategory(
        int $categoryId
    ) : JsonResponse
    {
        /**
         * Getting category icons
         */
        $categoryIcons = $this->categoryIconRepository->getForCategory(
            $categoryId
        );

        return $this->respondWithSuccess(
            $this->transformCollection($categoryIcons, new CategoryIconTransformer),
            trans('validations/api/guest/category/icon/getForCategory.result.success')
        );
    }

    /**
     * @param GetForCategoriesRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForCategories(
        GetForCategoriesRequest $request
    ) : JsonResponse
    {
        /**
         * Getting category icons
         */
        $categoryIcons = $this->categoryIconRepository->getForCategories(
            $request->input('categories_ids')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($categoryIcons, new CategoryIconTransformer),
            trans('validations/api/guest/category/icon/getForCategories.result.success')
        );
    }
}
