<?php

namespace App\Http\Controllers\Api\Guest\User;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\User\Interfaces\UserAvatarControllerInterface;
use App\Http\Requests\Api\Guest\User\Avatar\GetForUsersRequest;
use App\Repositories\User\UserAvatarRepository;
use App\Transformers\Api\Guest\User\UserAvatarTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class UserAvatarController
 *
 * @package App\Http\Controllers\Api\Guest\User
 */
final class UserAvatarController extends BaseController implements UserAvatarControllerInterface
{
    /**
     * @var UserAvatarRepository
     */
    protected UserAvatarRepository $userAvatarRepository;

    /**
     * UserAvatarController constructor
     */
    public function __construct()
    {
        /** @var UserAvatarRepository userAvatarRepository */
        $this->userAvatarRepository = new UserAvatarRepository();

        parent::__construct();
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
        $userAvatars = $this->userAvatarRepository->getForUsers(
            $request->input('auth_ids')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($userAvatars, new UserAvatarTransformer),
            trans('validations/api/guest/user/avatar/getForUsers.result.success')
        );
    }
}
