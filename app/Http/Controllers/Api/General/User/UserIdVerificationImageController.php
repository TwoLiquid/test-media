<?php

namespace App\Http\Controllers\Api\General\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\User\Interfaces\UserIdVerificationImageControllerInterface;
use App\Http\Requests\Api\General\User\IdVerification\Image\StoreRequest;
use App\Repositories\User\UserIdVerificationImageRepository;
use App\Services\User\UserIdVerificationImageService;
use App\Transformers\Api\General\User\IdVerification\UserIdVerificationImageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class UserIdVerificationImageController
 *
 * @package App\Http\Controllers\Api\General\User
 */
final class UserIdVerificationImageController extends BaseController implements UserIdVerificationImageControllerInterface
{
    /**
     * @var UserIdVerificationImageRepository
     */
    protected UserIdVerificationImageRepository $userIdVerificationImageRepository;

    /**
     * @var UserIdVerificationImageService
     */
    protected UserIdVerificationImageService $userIdVerificationImageService;

    /**
     * UserIdVerificationImageController constructor
     */
    public function __construct()
    {
        /** @var UserIdVerificationImageRepository userIdVerificationImageRepository */
        $this->userIdVerificationImageRepository = new UserIdVerificationImageRepository();

        /** @var UserIdVerificationImageService userIdVerificationImageService */
        $this->userIdVerificationImageService = new UserIdVerificationImageService();

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
         * Creating user id verification image
         */
        $userIdVerificationImage = $this->userIdVerificationImageService->createImage(
            $authId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension'),
            $request->input('request_id')
        );

        return $this->respondWithSuccess(
            $this->transformItem($userIdVerificationImage, new UserIdVerificationImageTransformer),
            trans('validations/api/general/user/idVerification/image/store.result.success')
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
         * Updating user id verification images
         */
        $this->userIdVerificationImageRepository->declineForRequest(
            $requestId
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/idVerification/image/declineForRequest.result.success')
        );
    }
}
