<?php

namespace App\Http\Controllers\Api\General\User\Interfaces;

use App\Http\Requests\Api\General\User\VoiceSample\StoreRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Interface UserVoiceSampleControllerInterface
 *
 * @package App\Http\Controllers\Api\General\User\Interfaces
 */
interface UserVoiceSampleControllerInterface
{
    /**
     * This method provides storing single row
     * by related entity repository
     *
     * @param int $authId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(
        int $authId,
        StoreRequest $request
    ) : JsonResponse;

    /**
     * This method provides updating row
     * by related entity repository
     *
     * @param string $requestId
     *
     * @return JsonResponse
     */
    public function acceptForRequest(
        string $requestId
    ) : JsonResponse;

    /**
     * This method provides updating row
     * by related entity repository
     *
     * @param string $requestId
     *
     * @return JsonResponse
     */
    public function declineForRequest(
        string $requestId
    ) : JsonResponse;

    /**
     * This method provides downloading single file
     * from a private storage environment
     *
     * @param int $id
     *
     * @return BinaryFileResponse|null
     */
    public function downloadFile(
        int $id
    ) : ?BinaryFileResponse;
}
