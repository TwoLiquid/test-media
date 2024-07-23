<?php

namespace App\Http\Controllers\Api\General\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\User\Interfaces\UserAvatarControllerInterface;
use App\Http\Requests\Api\General\User\Avatar\StoreRequest;
use App\Repositories\User\UserAvatarRepository;
use App\Services\User\UserAvatarService;
use App\Transformers\Api\General\User\Avatar\UserAvatarTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class UserAvatarController
 *
 * @package App\Http\Controllers\Api\General\User
 */
final class UserAvatarController extends BaseController implements UserAvatarControllerInterface
{
    /**
     * @var UserAvatarRepository
     */
    protected UserAvatarRepository $userAvatarRepository;

    /**
     * @var UserAvatarService
     */
    protected UserAvatarService $userAvatarService;

    /**
     * UserAvatarController constructor
     */
    public function __construct()
    {
        /** @var UserAvatarRepository userAvatarRepository */
        $this->userAvatarRepository = new UserAvatarRepository();

        /** @var UserAvatarService userAvatarService */
        $this->userAvatarService = new UserAvatarService();

        parent::__construct();
    }

    /**
     * @param int $authId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function store(
        int $authId,
        StoreRequest $request
    ) : JsonResponse
    {
        /**
         * Creating user avatar
         */
        $userAvatar = $this->userAvatarService->createImage(
            $authId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension'),
            $request->input('request_id')
        );

        return $this->respondWithSuccess(
            $this->transformItem($userAvatar, new UserAvatarTransformer),
            trans('validations/api/general/user/avatar/store.result.success')
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
         * Updating user avatars
         */
        $this->userAvatarRepository->acceptForRequest(
            $requestId
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/avatar/acceptForRequest.result.success')
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
         * Updating user avatars
         */
        $this->userAvatarRepository->declineForRequest(
            $requestId
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/avatar/declineForRequest.result.success')
        );
    }
}
