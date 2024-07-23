<?php

namespace App\Services\Chat\Interfaces;

use App\Models\MySql\Chat\ChatMessageVideo;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ChatMessageVideoServiceInterface
 *
 * @package App\Services\Chat\Interfaces
 */
interface ChatMessageVideoServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $chatMessageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return ChatMessageVideo
     */
    public function createVideo(
        string $chatMessageId,
        string $content,
        string $mime,
        string $extension
    ) : ChatMessageVideo;

    /**
     * This method provides creating data
     *
     * @param string $chatMessageId
     * @param array $chatMessageVideoFiles
     *
     * @return Collection
     */
    public function createVideos(
        string $chatMessageId,
        array $chatMessageVideoFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param ChatMessageVideo $chatMessageVideo
     *
     * @return bool
     */
    public function deleteVideo(
        ChatMessageVideo $chatMessageVideo
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $chatMessageVideos
     *
     * @return bool
     */
    public function deleteVideos(
        Collection $chatMessageVideos
    ) : bool;
}
