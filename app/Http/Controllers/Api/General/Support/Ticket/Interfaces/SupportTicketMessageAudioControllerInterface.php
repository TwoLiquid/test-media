<?php

namespace App\Http\Controllers\Api\General\Support\Ticket\Interfaces;

use App\Http\Requests\Api\General\Support\Ticket\Message\Audio\DestroyManyRequest;
use App\Http\Requests\Api\General\Support\Ticket\Message\Audio\StoreManyRequest;
use App\Http\Requests\Api\General\Support\Ticket\Message\Audio\StoreRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Interface SupportTicketMessageAudioControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Support\Ticket\Interfaces
 */
interface SupportTicketMessageAudioControllerInterface
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
