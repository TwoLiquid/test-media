<?php

namespace App\Http\Controllers\Api\General\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\User\Interfaces\UserBackgroundControllerInterface;
use App\Http\Requests\Api\General\User\Background\StoreRequest;
use App\Repositories\User\UserBackgroundRepository;
use App\Services\User\UserBackgroundService;
use App\Transformers\Api\General\User\Background\UserBackgroundTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class UserBackgroundController
 *
 * @package App\Http\Controllers\Api\General\User
 */
final class UserBackgroundController extends BaseController implements UserBackgroundControllerInterface
{
    /**
     * @var UserBackgroundRepository
     */
    protected UserBackgroundRepository $userBackgroundRepository;

    /**
     * @var UserBackgroundService
     */
    protected UserBackgroundService $userBackgroundService;

    /**
     * UserBackgroundController constructor
     */
    public function __construct()
    {
        /** @var UserBackgroundRepository userBackgroundRepository */
        $this->userBackgroundRepository = new UserBackgroundRepository();

        /** @var UserBackgroundService userBackgroundService */
        $this->userBackgroundService = new UserBackgroundService();

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
         * Creating a user background
         */
        $userBackground = $this->userBackgroundService->createImage(
            $authId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension'),
            $request->input('request_id')
        );

        return $this->respondWithSuccess(
            $this->transformItem($userBackground, new UserBackgroundTransformer),
            trans('validations/api/general/user/background/store.result.success')
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
         * Updating user backgrounds
         */
        $this->userBackgroundRepository->acceptForRequest(
            $requestId
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/background/acceptForRequest.result.success')
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
         * Updating user backgrounds
         */
        $this->userBackgroundRepository->declineForRequest(
            $requestId
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/background/declineForRequest.result.success')
        );
    }
}
