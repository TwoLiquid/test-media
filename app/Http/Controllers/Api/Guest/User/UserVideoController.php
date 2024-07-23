<?php

namespace App\Http\Controllers\Api\Guest\User;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\User\Interfaces\UserVideoControllerInterface;
use App\Repositories\User\UserVideoRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class UserVideoController
 *
 * @package App\Http\Controllers\Api\Guest\User
 */
final class UserVideoController extends BaseController implements UserVideoControllerInterface
{
    /**
     * @var UserVideoRepository
     */
    protected UserVideoRepository $userVideoRepository;

    /**
     * UserVideoController constructor
     */
    public function __construct()
    {
        /** @var UserVideoRepository userVideoRepository */
        $this->userVideoRepository = new UserVideoRepository();

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
         * Checking user video existence
         */
        if (!$this->userVideoRepository->findForUser(
            $authId,
            $id
        )) {
            return $this->respondWithError(
                trans('validations/api/guest/user/video/existsForUser.result.error')
            );
        }

        return $this->respondWithSuccess([],
            trans('validations/api/guest/user/video/existsForUser.result.success')
        );
    }
}
