<?php

namespace App\Http\Controllers\Api\Guest\User;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\User\Interfaces\UserImageControllerInterface;
use App\Repositories\User\UserImageRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class UserImageController
 *
 * @package App\Http\Controllers\Api\Guest\User
 */
final class UserImageController extends BaseController implements UserImageControllerInterface
{
    /**
     * @var UserImageRepository
     */
    protected UserImageRepository $userImageRepository;

    /**
     * UserImageController constructor
     */
    public function __construct()
    {
        /** @var UserImageRepository userImageRepository */
        $this->userImageRepository = new UserImageRepository();

        parent::__construct();
    }

    /**
     * @param int $authId
     * @param int $id
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function existsForUser(
        int $authId,
        int $id
    ) : JsonResponse
    {
        /**
         * Checking user image existence
         */
        if (!$this->userImageRepository->findForUser(
            $authId,
            $id
        )) {
            return $this->respondWithError(
                trans('validations/api/guest/user/image/existsForUser.result.error')
            );
        }

        return $this->respondWithSuccess([],
            trans('validations/api/guest/user/image/existsForUser.result.success')
        );
    }
}
