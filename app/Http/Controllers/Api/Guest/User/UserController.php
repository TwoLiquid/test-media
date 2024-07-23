<?php

namespace App\Http\Controllers\Api\Guest\User;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\User\Interfaces\UserControllerInterface;
use App\Http\Requests\Api\Guest\User\GetForUserRequest;
use App\Http\Requests\Api\Guest\User\GetForUsersRequest;
use App\Repositories\Activity\ActivityImageRepository;
use App\Repositories\User\UserAvatarRepository;
use App\Repositories\User\UserBackgroundRepository;
use App\Repositories\User\UserImageRepository;
use App\Repositories\User\UserVideoRepository;
use App\Repositories\User\UserVoiceSampleRepository;
use App\Repositories\Vybe\VybeImageRepository;
use App\Repositories\Vybe\VybeVideoRepository;
use App\Services\User\UserAvatarService;
use App\Services\User\UserBackgroundService;
use App\Services\User\UserImageService;
use App\Services\User\UserVideoService;
use App\Services\User\UserVoiceSampleService;
use App\Transformers\Api\Guest\User\UserTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Api\Guest\User
 */
final class UserController extends BaseController implements UserControllerInterface
{
    /**
     * @var ActivityImageRepository
     */
    protected ActivityImageRepository $activityImageRepository;

    /**
     * @var UserAvatarRepository
     */
    protected UserAvatarRepository $userAvatarRepository;

    /**
     * @var UserAvatarService
     */
    protected UserAvatarService $userAvatarService;

    /**
     * @var UserBackgroundRepository
     */
    protected UserBackgroundRepository $userBackgroundRepository;

    /**
     * @var UserBackgroundService
     */
    protected UserBackgroundService $userBackgroundService;

    /**
     * @var UserImageRepository
     */
    protected UserImageRepository $userImageRepository;

    /**
     * @var UserImageService
     */
    protected UserImageService $userImageService;

    /**
     * @var UserVideoRepository
     */
    protected UserVideoRepository $userVideoRepository;

    /**
     * @var UserVideoService
     */
    protected UserVideoService $userVideoService;

    /**
     * @var UserVoiceSampleRepository
     */
    protected UserVoiceSampleRepository $userVoiceSampleRepository;

    /**
     * @var UserVoiceSampleService
     */
    protected UserVoiceSampleService $userVoiceSampleService;

    /**
     * @var VybeImageRepository
     */
    protected VybeImageRepository $vybeImageRepository;

    /**
     * @var VybeVideoRepository
     */
    protected VybeVideoRepository $vybeVideoRepository;

    /**
     * UserController constructor
     */
    public function __construct()
    {
        /** @var ActivityImageRepository activityImageRepository */
        $this->activityImageRepository = new ActivityImageRepository();

        /** @var UserAvatarRepository userAvatarRepository */
        $this->userAvatarRepository = new UserAvatarRepository();

        /** @var UserAvatarService userAvatarService */
        $this->userAvatarService = new UserAvatarService();

        /** @var UserBackgroundRepository userBackgroundRepository */
        $this->userBackgroundRepository = new UserBackgroundRepository();

        /** @var UserBackgroundService userBackgroundService */
        $this->userBackgroundService = new UserBackgroundService();

        /** @var UserImageRepository userImageRepository */
        $this->userImageRepository = new UserImageRepository();

        /** @var UserImageService userImageService */
        $this->userImageService = new UserImageService();

        /** @var UserVideoRepository userVideoRepository */
        $this->userVideoRepository = new UserVideoRepository();

        /** @var UserVideoService userVideoService */
        $this->userVideoService = new UserVideoService();

        /** @var UserVoiceSampleRepository userVoiceSampleRepository */
        $this->userVoiceSampleRepository = new UserVoiceSampleRepository();

        /** @var UserVoiceSampleService userVoiceSampleService */
        $this->userVoiceSampleService = new UserVoiceSampleService();

        /** @var VybeImageRepository vybeImageRepository */
        $this->vybeImageRepository = new VybeImageRepository();

        /** @var VybeVideoRepository vybeVideoRepository */
        $this->vybeVideoRepository = new VybeVideoRepository();

        parent::__construct();
    }

    /**
     * @param int $authId
     * @param GetForUserRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForUser(
        int $authId,
        GetForUserRequest $request
    ) : JsonResponse
    {
        /**
         * Getting user avatars
         */
        $userAvatars = $this->userAvatarRepository->getByIds(
            $request->input('avatars_ids')
        );

        /**
         * Getting user voice samples
         */
        $userVoiceSamples = $this->userVoiceSampleRepository->getByIds(
            $request->input('voice_samples_ids')
        );

        /**
         * Getting user background
         */
        $userBackgrounds = $this->userBackgroundRepository->getByIds(
            $request->input('backgrounds_ids')
        );

        /**
         * Getting user images
         */
        $userImages = $this->userImageRepository->getByIds(
            $request->input('images_ids')
        );

        /**
         * Getting user videos
         */
        $userVideos = $this->userVideoRepository->getByIds(
            $request->input('videos_ids')
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
        $activityImages = $this->activityImageRepository->getForActivities(
            $request->input('activities_ids')
        );

        return $this->respondWithSuccess(
            $this->transformItem([],
                new UserTransformer(
                    $userAvatars,
                    $userVoiceSamples,
                    $userBackgrounds,
                    $userImages,
                    $userVideos,
                    $vybeImages,
                    $vybeVideos,
                    $activityImages
                )
            )['user'],
            trans('validations/api/guest/user/getForUser.result.success')
        );
    }

    /**
     * @param GetForUsersRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForUsers(
        GetForUsersRequest $request
    ) : JsonResponse
    {
        /**
         * Getting user avatars
         */
        $userAvatars = $this->userAvatarRepository->getByIds(
            $request->input('avatars_ids')
        );

        /**
         * Getting user voice samples
         */
        $userVoiceSamples = $this->userVoiceSampleRepository->getByIds(
            $request->input('voice_samples_ids')
        );

        /**
         * Getting user backgrounds
         */
        $userBackgrounds = $this->userBackgroundRepository->getByIds(
            $request->input('backgrounds_ids')
        );

        /**
         * Getting user images
         */
        $userImages = $this->userImageRepository->getByIds(
            $request->input('images_ids')
        );

        /**
         * Getting user videos
         */
        $userVideos = $this->userVideoRepository->getByIds(
            $request->input('videos_ids')
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
        $activityImages = $this->activityImageRepository->getForActivities(
            $request->input('activities_ids')
        );

        return $this->respondWithSuccess(
            $this->transformItem([],
                new UserTransformer(
                    $userAvatars,
                    $userVoiceSamples,
                    $userBackgrounds,
                    $userImages,
                    $userVideos,
                    $vybeImages,
                    $vybeVideos,
                    $activityImages
                )
            )['user'],
            trans('validations/api/guest/user/getForUsers.result.success')
        );
    }

    /**
     * @param string $requestId
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForRequest(
        string $requestId
    ) : JsonResponse
    {
        /**
         * Getting user avatars
         */
        $userAvatars = $this->userAvatarRepository->getForRequest(
            $requestId
        );

        /**
         * Getting user voice sample
         */
        $userVoiceSamples = $this->userVoiceSampleRepository->getForRequest(
            $requestId
        );

        /**
         * Getting user backgrounds
         */
        $userBackgrounds = $this->userBackgroundRepository->getForRequest(
            $requestId
        );

        /**
         * Getting user images
         */
        $userImages = $this->userImageRepository->getForRequest(
            $requestId
        );

        /**
         * Getting user videos
         */
        $userVideos = $this->userVideoRepository->getForRequest(
            $requestId
        );

        return $this->respondWithSuccess(
            $this->transformItem([],
                new UserTransformer(
                    $userAvatars,
                    $userVoiceSamples,
                    $userBackgrounds,
                    $userImages,
                    $userVideos
                )
            )['user'],
            trans('validations/api/guest/user/getForRequest.result.success')
        );
    }
}
