<?php

namespace App\Http\Controllers\Api\General\Activity;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\General\Activity\Interfaces\ActivityImageControllerInterface;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\General\Activity\Image\StoreManyRequest;
use App\Repositories\Activity\ActivityImageRepository;
use App\Services\Activity\ActivityImageService;
use App\Transformers\Api\Guest\Activity\ActivityImageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class ActivityImageController
 *
 * @package App\Http\Controllers\Api\General\Activity
 */
final class ActivityImageController extends BaseController implements ActivityImageControllerInterface
{
    /**
     * @var ActivityImageRepository
     */
    protected ActivityImageRepository $activityImageRepository;

    /**
     * @var ActivityImageService
     */
    protected ActivityImageService $activityImageService;

    /**
     * ActivityImageController constructor
     */
    public function __construct()
    {
        /** @var ActivityImageRepository activityImageRepository */
        $this->activityImageRepository = new ActivityImageRepository();

        /** @var ActivityImageService activityImageService */
        $this->activityImageService = new ActivityImageService();

        parent::__construct();
    }

    /**
     * @param int $activityId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function storeMany(
        int $activityId,
        StoreManyRequest $request
    ) : JsonResponse
    {
        /**
         * Getting activity images
         */
        $activityImages = $this->activityImageRepository->getForActivityByTypes(
            $activityId,
            collect($request->input('activity_images'))
                ->pluck('type')
                ->values()
                ->toArray()
        );

        /**
         * Deleting activity images
         */
        $this->activityImageService->deleteImages(
            $activityImages
        );

        /**
         * Creating activity images
         */
        $activityImages = $this->activityImageService->createImages(
            $activityId,
            $request->input('activity_images')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($activityImages, new ActivityImageTransformer),
            trans('validations/api/general/activity/image/storeMany.result.success')
        );
    }

    /**
     * @param int $activityId
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function destroy(
        int $activityId
    ) : JsonResponse
    {
        /**
         * Getting activity images
         */
        $activityImages = $this->activityImageRepository->getForActivity(
            $activityId
        );

        /**
         * Deleting activity images
         */
        $this->activityImageService->deleteImages(
            $activityImages
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/activity/image/destroy.result.success')
        );
    }
}
