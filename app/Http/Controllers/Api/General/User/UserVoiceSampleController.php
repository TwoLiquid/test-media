<?php

namespace App\Http\Controllers\Api\General\User;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\User\Interfaces\UserVoiceSampleControllerInterface;
use App\Http\Requests\Api\General\User\VoiceSample\StoreRequest;
use App\Repositories\User\UserVoiceSampleRepository;
use App\Services\User\UserVoiceSampleService;
use App\Transformers\Api\General\User\VoiceSample\UserVoiceSampleTransformer;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Class UserVoiceSampleController
 *
 * @package App\Http\Controllers\Api\General\User
 */
final class UserVoiceSampleController extends BaseController implements UserVoiceSampleControllerInterface
{
    /**
     * @var UserVoiceSampleRepository
     */
    protected UserVoiceSampleRepository $userVoiceSampleRepository;

    /**
     * @var UserVoiceSampleService
     */
    protected UserVoiceSampleService $userVoiceSampleService;

    /**
     * UserVoiceSampleController constructor
     */
    public function __construct()
    {
        /** @var UserVoiceSampleRepository userVoiceSampleRepository */
        $this->userVoiceSampleRepository = new UserVoiceSampleRepository();

        /** @var UserVoiceSampleRepository userVoiceSampleService */
        $this->userVoiceSampleService = new UserVoiceSampleService();

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
         * Creating user voice sample
         */
        $userVoiceSample = $this->userVoiceSampleService->createAudio(
            $authId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension'),
            $request->input('request_id')
        );

        return $this->respondWithSuccess(
            $this->transformItem($userVoiceSample, new UserVoiceSampleTransformer),
            trans('validations/api/general/user/voiceSample/store.result.success')
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
         * Updating user voice samples
         */
        $this->userVoiceSampleRepository->acceptForRequest(
            $requestId
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/voiceSample/acceptForRequest.result.success')
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
         * Updating user voice samples
         */
        $this->userVoiceSampleRepository->declineForRequest(
            $requestId
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/user/voiceSample/declineForRequest.result.success')
        );
    }

    /**
     * @param int $id
     *
     * @return BinaryFileResponse|null
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function downloadFile(
        int $id
    ) : ?BinaryFileResponse
    {
        /**
         * Getting user voice sample
         */
        $userVoiceSample = $this->userVoiceSampleRepository->findById($id);

        /**
         * Checking user voice sample existence
         */
        if (!$userVoiceSample) {
            throw new BaseException(
                trans('validations/api/general/user/voiceSample/downloadFile.result.error'),
                null,
                400
            );
        }

        return $this->respondWithDownload(
            $userVoiceSample->url,
            'public'
        );
    }
}
