<?php

namespace App\Http\Controllers\Api\General\Chat\Interfaces;

use App\Http\Requests\Api\General\Chat\Message\GetForChatMessagesRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface ChatMessageControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Chat\Interfaces
 */
interface ChatMessageControllerInterface
{
    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param GetForChatMessagesRequest $request
     *
     * @return JsonResponse
     */
    public function getForChatMessages(
        GetForChatMessagesRequest $request
    ) : JsonResponse;

    /**
     * This method provides deletion rows
     * by related entity repository
     *
     * @param string $chatMessageId
     *
     * @return JsonResponse
     */
    public function deleteForChatMessage(
        string $chatMessageId
    ) : JsonResponse;
}
