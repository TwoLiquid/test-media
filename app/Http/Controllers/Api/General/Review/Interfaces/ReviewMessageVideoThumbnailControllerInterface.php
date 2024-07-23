<?php

namespace App\Http\Controllers\Api\General\Review\Interfaces;

use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Interface ReviewMessageVideoThumbnailControllerInterface
 *
 * @package App\Http\Controllers\Api\General\Review\Interfaces
 */
interface ReviewMessageVideoThumbnailControllerInterface
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
