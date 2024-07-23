<?php

namespace App\Http\Controllers\Api\Guest\User;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\User\Interfaces\UserIdVerificationImageControllerInterface;
use App\Repositories\User\UserIdVerificationImageRepository;
use App\Transformers\Api\Guest\User\UserIdVerificationImageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class UserIdVerificationImageController
 *
 * @package App\Http\Controllers\Api\Guest\User
 */
final class UserIdVerificationImageController extends BaseController implements UserIdVerificationImageControllerInterface
{
    /**
     * @var UserIdVerificationImageRepository
     */
    protected UserIdVerificationImageRepository $userIdVerificationImageRepository;

    /**
     * UserIdVerificationImageController constructor
     */
    public function __construct()
    {
        /** @var UserIdVerificationImageRepository userIdVerificationImageRepository */
        $this->userIdVerificationImageRepository = new UserIdVerificationImageRepository();

        parent::__construct();
    }

    /**
     * @param int $authId
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForUser(
        int $authId
    ) : JsonResponse
    {
        /**
         * Getting user id verification images
         */
        $userIdVerificationImages = $this->userIdVerificationImageRepository->getForUser(
            $authId
        );

        return $this->respondWithSuccess(
            $this->transformCollection(
                $userIdVerificationImages,
                new UserIdVerificationImageTransformer
            ), trans('validations/api/guest/user/idVerification/image/getForUser.result.success')
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
         * Getting user id verification images
         */
        $userIdVerificationImages = $this->userIdVerificationImageRepository->getAllForRequest(
            $requestId
        );

        return $this->respondWithSuccess(
            $this->transformCollection($userIdVerificationImages, new UserIdVerificationImageTransformer),
            trans('validations/api/guest/user/idVerification/image/getForRequest.result.success')
        );
    }
}
