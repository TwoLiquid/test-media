<?php

namespace App\Services\Review\Interfaces;

use App\Models\MySql\Review\ReviewMessageVideo;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ReviewMessageVideoServiceInterface
 *
 * @package App\Services\Review\Interfaces
 */
interface ReviewMessageVideoServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $messageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return ReviewMessageVideo
     */
    public function createVideo(
        string $messageId,
        string $content,
        string $mime,
        string $extension
    ) : ReviewMessageVideo;

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
     * @param ReviewMessageVideo $reviewMessageVideo
     *
     * @return bool
     */
    public function deleteVideo(
        ReviewMessageVideo $reviewMessageVideo
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $reviewMessageVideos
     *
     * @return bool
     */
    public function deleteVideos(
        Collection $reviewMessageVideos
    ) : bool;
}
