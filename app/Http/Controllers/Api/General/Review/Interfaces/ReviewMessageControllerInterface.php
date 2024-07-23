<?php

namespace App\Http\Controllers\Api\General\Review\Interfaces;

use App\Http\Requests\Api\General\Review\Message\GetForReviewMessagesRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface ReviewMessageControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Review\Interfaces
 */
interface ReviewMessageControllerInterface
{
    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param GetForReviewMessagesRequest $request
     *
     * @return JsonResponse
     */
    public function getForReviewMessages(
        GetForReviewMessagesRequest $request
    ) : JsonResponse;

    /**
     * This method provides deletion rows
     * by related entity repository
     *
     * @param string $messageId
     *
     * @return JsonResponse
     */
    public function deleteForReviewMessage(
        string $messageId
    ) : JsonResponse;
}
