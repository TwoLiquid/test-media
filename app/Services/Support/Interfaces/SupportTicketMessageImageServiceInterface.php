<?php

namespace App\Services\Support\Interfaces;

use App\Models\MySql\Support\SupportTicketMessageImage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SupportTicketMessageImageServiceInterface
 *
 * @package App\Services\Support\Interfaces
 */
interface SupportTicketMessageImageServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $messageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return SupportTicketMessageImage
     */
    public function createImage(
        string $messageId,
        string $content,
        string $mime,
        string $extension
    ) : SupportTicketMessageImage;

    /**
     * This method provides creating data
     *
     * @param string $messageId
     * @param array $imageFiles
     *
     * @return Collection
     */
    public function createImages(
        string $messageId,
        array $imageFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param SupportTicketMessageImage $supportTicketMessageImage
     *
     * @return bool
     */
    public function deleteImage(
        SupportTicketMessageImage $supportTicketMessageImage
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $supportTicketMessageImages
     *
     * @return bool
     */
    public function deleteImages(
        Collection $supportTicketMessageImages
    ) : bool;
}
