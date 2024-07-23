<?php

namespace App\Http\Controllers\Api\Guest\Search;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\Search\Interfaces\SearchControllerInterface;
use App\Http\Requests\Api\Guest\Search\GetForClientGlobalRequest;
use App\Repositories\Activity\ActivityImageRepository;
use App\Repositories\User\UserAvatarRepository;
use App\Repositories\User\UserVoiceSampleRepository;
use App\Repositories\Vybe\VybeImageRepository;
use App\Repositories\Vybe\VybeVideoRepository;
use App\Transformers\Api\Guest\Search\ClientGlobalTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class SearchController
 *
 * @package App\Http\Controllers\Api\Guest\Search
 */
class SearchController extends BaseController implements SearchControllerInterface
{
    /**
     * @var ActivityImageRepository
     */
    protected ActivityImageRepository $activityImageRepository;

    /**
     * @var VybeImageRepository
     */
    protected VybeImageRepository $vybeImageRepository;

    /**
     * @var VybeVideoRepository
     */
    protected VybeVideoRepository $vybeVideoRepository;

    /**
     * @var UserAvatarRepository
     */
    protected UserAvatarRepository $userAvatarRepository;

    /**
     * @var UserVoiceSampleRepository
     */
    protected UserVoiceSampleRepository $userVoiceSampleRepository;

    /**
     * SearchController constructor
     */
    public function __construct()
    {
        /** @var ActivityImageRepository activityImageRepository */
        $this->activityImageRepository = new ActivityImageRepository();

        /** @var VybeImageRepository vybeImageRepository */
        $this->vybeImageRepository = new VybeImageRepository();

        /** @var VybeVideoRepository vybeVideoRepository */
        $this->vybeVideoRepository = new VybeVideoRepository();

        /** @var UserAvatarRepository userAvatarRepository */
        $this->userAvatarRepository = new UserAvatarRepository();

        /** @var UserVoiceSampleRepository userVoiceSampleRepository */
        $this->userVoiceSampleRepository = new UserVoiceSampleRepository();

        parent::__construct();
    }

    /**
     * @param GetForClientGlobalRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForClientGlobal(
        GetForClientGlobalRequest $request
    ) : JsonResponse
    {
        /**
         * Getting user avatars
         */
        $userAvatars = $this->userAvatarRepository->getForUsers(
            $request->input('auth_ids')
        );

        /**
         * Getting user voice samples
         */
        $userVoiceSamples = $this->userVoiceSampleRepository->getForUsers(
            $request->input('auth_ids')
        );

        /**
         * Getting vybe images
         */
        $vybeImages = $this->vybeImageRepository->getByIds(
            $request->input('vybe_images_ids')
        );

        /**
         * Getting vybe videos
         */
        $vybeVideos = $this->vybeVideoRepository->getByIds(
            $request->input('vybe_videos_ids')
        );

        /**
         * Getting activity images
         */
        $activityImages = $this->activityImageRepository->getPostersForActivities(
            $request->input('activities_ids')
        );

        return $this->respondWithSuccess(
            $this->transformItem([], new ClientGlobalTransformer(
                $userAvatars,
                $userVoiceSamples,
                $vybeImages,
                $vybeVideos,
                $activityImages
            )), trans('validations/api/guest/search/getForClientGlobal.result.success')
        );
    }
}
