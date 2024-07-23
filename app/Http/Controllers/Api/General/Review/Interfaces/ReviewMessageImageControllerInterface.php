<?php

namespace App\Http\Controllers\Api\General\Review\Interfaces;

use App\Http\Requests\Api\General\Review\Message\Image\DestroyManyRequest;
use App\Http\Requests\Api\General\Review\Message\Image\StoreManyRequest;
use App\Http\Requests\Api\General\Review\Message\Image\StoreRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Interface ReviewMessageImageControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Review\Interfaces
 */
interface ReviewMessageImageControllerInterface
{
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

    /**
     * This method provides downloading single file
     * from a private storage environment
     *
     * @param int $id
     *
     * @return BinaryFileResponse|null
     */
    public function downloadMinFile(
        int $id
    ) : ?BinaryFileResponse;

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
