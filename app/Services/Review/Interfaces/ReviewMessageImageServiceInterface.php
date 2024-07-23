<?php

namespace App\Services\Review\Interfaces;

use App\Models\MySql\Review\ReviewMessageImage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ReviewMessageImageServiceInterface
 *
 * @package App\Services\Review\Interfaces
 */
interface ReviewMessageImageServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $messageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return ReviewMessageImage
     */
    public function createImage(
        string $messageId,
        string $content,
        string $mime,
        string $extension
    ) : ReviewMessageImage;

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
     * @param ReviewMessageImage $reviewMessageImage
     *
     * @return bool
     */
    public function deleteImage(
        ReviewMessageImage $reviewMessageImage
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $reviewMessageImages
     *
     * @return bool
     */
    public function deleteImages(
        Collection $reviewMessageImages
    ) : bool;
}
