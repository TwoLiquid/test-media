<?php

namespace App\Http\Controllers\Api\General\Chat\Interfaces;

use App\Http\Requests\Api\General\Chat\Message\Video\DestroyManyRequest;
use App\Http\Requests\Api\General\Chat\Message\Video\StoreManyRequest;
use App\Http\Requests\Api\General\Chat\Message\Video\StoreRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Interface ChatMessageVideoControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Chat\Interfaces
 */
interface ChatMessageVideoControllerInterface
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
     * @param string $chatMessageId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     */
    public function store(
        string $chatMessageId,
        StoreRequest $request
    ) : JsonResponse;

    /**
     * This method provides storing rows
     * by related entity repository
     *
     * @param string $chatMessageId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     */
    public function storeMany(
        string $chatMessageId,
        StoreManyRequest $request
    ) : JsonResponse;

    /**
     * This method provides deleting rows
     * by related entity repository
     *
     * @param string $chatMessageId
     * @param DestroyManyRequest $request
     *
     * @return JsonResponse
     */
    public function destroyMany(
        string $chatMessageId,
        DestroyManyRequest $request
    ) : JsonResponse;
}