<?php

namespace App\Services\Support\Interfaces;

use App\Models\MySql\Support\SupportTicketMessageVideo;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface SupportTicketMessageVideoServiceInterface
 *
 * @package App\Services\Support\Interfaces
 */
interface SupportTicketMessageVideoServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $messageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return SupportTicketMessageVideo
     */
    public function createVideo(
        string $messageId,
        string $content,
        string $mime,
        string $extension
    ) : SupportTicketMessageVideo;

    /**
     * This method provides creating data
     *
     * @param string $messageId
     * @param array $videoFiles
     *
     * @return Collection
     */
    public function createVideos(
        string $messageId,
        array $videoFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param SupportTicketMessageVideo $supportTicketMessageVideo
     *
     * @return bool
     */
    public function deleteVideo(
        SupportTicketMessageVideo $supportTicketMessageVideo
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $supportTicketMessageVideos
     *
     * @return bool
     */
    public function deleteVideos(
        Collection $supportTicketMessageVideos
    ) : bool;
}
