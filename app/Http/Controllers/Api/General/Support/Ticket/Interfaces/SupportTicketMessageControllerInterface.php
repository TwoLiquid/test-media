<?php

namespace App\Http\Controllers\Api\General\Support\Ticket\Interfaces;

use App\Http\Requests\Api\General\Support\Ticket\Message\GetForSupportTicketMessagesRequest;
use Illuminate\Http\JsonResponse;

/**
 * Interface SupportTicketMessageControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Support\Ticket\Interfaces
 */
interface SupportTicketMessageControllerInterface
{
    /**
     * This method provides getting all rows
     * by related entity repository
     *
     * @param GetForSupportTicketMessagesRequest $request
     *
     * @return JsonResponse
     */
    public function getForSupportTicketMessages(
        GetForSupportTicketMessagesRequest $request
    ) : JsonResponse;

    /**
     * This method provides deletion rows
     * by related entity repository
     *
     * @param string $messageId
     *
     * @return JsonResponse
     */
    public function deleteForSupportTicketMessage(
        string $messageId
    ) : JsonResponse;
}
