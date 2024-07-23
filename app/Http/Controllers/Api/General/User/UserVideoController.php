<?php

namespace App\Http\Controllers\Api\General\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\User\Interfaces\UserVideoControllerInterface;
use App\Http\Requests\Api\General\User\Video\StoreManyRequest;
use App\Http\Requests\Api\General\User\Video\UpdateLikesRequest;
use App\Repositories\User\UserVideoRepository;
use App\Services\User\UserVideoService;
use App\Transformers\Api\General\User\Video\UserVideoTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class UserVideoController
 *
 * @package App\Http\Controllers\Api\General\User
 */
final class UserVideoController extends BaseController implements UserVideoControllerInterface
{
    /**
     * @var UserVideoRepository
     */
    protected UserVideoRepository $userVideoRepository;

    /**
     * @var UserVideoService
     */
    protected UserVideoService $userVideoService;

    /**
     * UserVideoController constructor
     */
    public function __construct()
    {
        /** @var UserVideoRepository userVideoRepository */
        $this->userVideoRepository = new UserVideoRepository();

        /** @var UserVideoService userVideoService */
        $this->userVideoService = new UserVideoService();

        parent::__construct();
    }

    /**
     * @param int $authId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function storeMany(
        int $authId,
        StoreManyRequest $request
    ) : JsonResponse
    {
        /**
         * Creating user videos
         */
        $userVideos = $this->userVideoService->createVideos(
            $authId,
            $request->input('user_videos')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($userVideos, new UserVideoTransformer),
            trans('validations/api/general/user/video/storeMany.result.success')
        );
    }

    /**
     * @param string $requestId
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function acceptForRequest(
        string $requestId
    ) : JsonResponse
    {
        /**
         * Updating user videos
         */
        $this->userVideoRepository->acceptForRequest(
            $requestId
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/video/acceptForRequest.result.success')
        );
    }

    /**
     * @param string $requestId
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function declineForRequest(
        string $requestId
    ) : JsonResponse
    {
        /**
         * Updating user videos
         */
        $this->userVideoRepository->declineForRequest(
            $requestId
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/video/declineForRequest.result.success')
        );
    }

    /**
     * @param int $id
     * @param UpdateLikesRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function updateLikes(
        int $id,
        UpdateLikesRequest $request
    ) : JsonResponse
    {
        /**
         * Getting user video
         */
        $userVideo = $this->userVideoRepository->findById($id);

        /**
         * Checking user video existence
         */
        if (!$userVideo) {
            return $this->respondWithError(
                trans('validations/api/general/user/video/updateLikes.result.error')
            );
        }

        /**
         * Updating user video
         */
        $userVideo = $this->userVideoRepository->updateLikes(
            $userVideo,
            $request->input('likes')
        );

        return $this->respondWithSuccess(
            $this->transformItem($userVideo, new UserVideoTransformer),
            trans('validations/api/general/user/video/updateLikes.result.success')
        );
    }
}
