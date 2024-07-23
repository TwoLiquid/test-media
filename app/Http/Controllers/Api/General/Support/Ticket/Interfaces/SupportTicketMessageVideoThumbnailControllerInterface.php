<?php

namespace App\Http\Controllers\Api\General\Support\Ticket\Interfaces;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Interface SupportTicketMessageVideoThumbnailControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Support\Ticket\Interfaces
 */
interface SupportTicketMessageVideoThumbnailControllerInterface
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
     * This method provides downloading single file
     * from a private storage environment
     *
     * @param int $id
     *
     * @return BinaryFileResponse
     */
    public function downloadMinFile(
        int $id
    ) : BinaryFileResponse;
}
