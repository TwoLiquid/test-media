<?php

namespace App\Http\Controllers\Api\General\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\User\Interfaces\UserImageControllerInterface;
use App\Http\Requests\Api\General\User\Image\StoreManyRequest;
use App\Http\Requests\Api\General\User\Image\UpdateLikesRequest;
use App\Repositories\User\UserImageRepository;
use App\Services\User\UserImageService;
use App\Transformers\Api\General\User\Image\UserImageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class UserImageController
 *
 * @package App\Http\Controllers\Api\General\User
 */
final class UserImageController extends BaseController implements UserImageControllerInterface
{
    /**
     * @var UserImageRepository
     */
    protected UserImageRepository $userImageRepository;

    /**
     * @var UserImageService
     */
    protected UserImageService $userImageService;

    /**
     * UserImageController constructor
     */
    public function __construct()
    {
        /** @var UserImageRepository userImageRepository */
        $this->userImageRepository = new UserImageRepository();

        /** @var UserImageService userImageService */
        $this->userImageService = new UserImageService();

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
         * Creating user images
         */
        $userImages = $this->userImageService->createImages(
            $authId,
            $request->input('user_images')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($userImages, new UserImageTransformer),
            trans('validations/api/general/user/image/storeMany.result.success')
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
         * Updating user images
         */
        $this->userImageRepository->acceptForRequest(
            $requestId
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/image/acceptForRequest.result.success')
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
         * Updating user images
         */
        $this->userImageRepository->declineForRequest(
            $requestId
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/image/declineForRequest.result.success')
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
         * Getting user image
         */
        $userImage = $this->userImageRepository->findById($id);

        /**
         * Checking user image existence
         */
        if (!$userImage) {
            return $this->respondWithError(
                trans('validations/api/general/user/image/updateLikes.result.error')
            );
        }

        /**
         * Creating user images
         */
        $userImage = $this->userImageRepository->updateLikes(
            $userImage,
            $request->input('likes')
        );

        return $this->respondWithSuccess(
            $this->transformItem($userImage, new UserImageTransformer),
            trans('validations/api/general/user/image/updateLikes.result.success')
        );
    }
}
