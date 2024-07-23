<?php

namespace App\Http\Controllers\Api\Guest\Activity;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\Guest\Activity\Interfaces\ActivityControllerInterface;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Guest\Activity\GetForActivitiesRequest;
use App\Repositories\Activity\ActivityImageRepository;
use App\Transformers\Api\Guest\Activity\ActivityImageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class ActivityController
 *
 * @package App\Http\Controllers\Api\Guest\Activity
 */
final class ActivityController extends BaseController implements ActivityControllerInterface
{
    /**
     * @var ActivityImageRepository
     */
    protected ActivityImageRepository $activityImageRepository;

    /**
     * ActivityController constructor
     */
    public function __construct()
    {
        /** @var ActivityImageRepository activityImageRepository */
        $this->activityImageRepository = new ActivityImageRepository();

        parent::__construct();
    }

    /**
     * @param int $activityId
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForActivity(
        int $activityId
    ) : JsonResponse
    {
        /**
         * Getting activity images
         */
        $activityImages = $this->activityImageRepository->getForActivity(
            $activityId
        );

        return $this->respondWithSuccess(
            $this->transformCollection($activityImages, new ActivityImageTransformer),
            trans('validations/api/guest/activity/image/getForActivity.result.success')
        );
    }

    /**
     * @param GetForActivitiesRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForActivities(
        GetForActivitiesRequest $request
    ) : JsonResponse
    {
        /**
         * Getting activities images
         */
        $activityImages = $this->activityImageRepository->getForActivities(
            $request->input('activities_ids')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($activityImages, new ActivityImageTransformer),
            trans('validations/api/guest/activity/image/getForActivities.result.success')
        );
    }
}
