<?php

namespace App\Http\Controllers\Api\General\Review\Interfaces;

use App\Http\Requests\Api\General\Review\Message\Video\DestroyManyRequest;
use App\Http\Requests\Api\General\Review\Message\Video\StoreManyRequest;
use App\Http\Requests\Api\General\Review\Message\Video\StoreRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Interface ReviewMessageVideoControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Review\Interfaces
 */
interface ReviewMessageVideoControllerInterface
{
    /**
     * This method provides downloading single file
     * from a private storage environment
     *
     * @param int $id
     *
     * @return BinaryFileResponse
     */
    public function downloadFile(
        int $id
    ) : BinaryFileResponse;

    /**
     * This method provides storing single row
     * by related entity repository
     *
     * @param string $messageId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(
        string $messageId,
        StoreRequest $request
    ) : JsonResponse;

    /**
     * This method provides storing rows
     * by related entity repository
     *
     * @param string $messageId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     */
    public function storeMany(
        string $messageId,
        StoreManyRequest $request
    ) : JsonResponse;

    /**
     * This method provides deleting rows
     * by related entity repository
     *
     * @param string $messageId
     * @param DestroyManyRequest $request
     *
     * @return JsonResponse
     */
    public function destroyMany(
        string $messageId,
        DestroyManyRequest $request
    ) : JsonResponse;
}
