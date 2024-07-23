<?php

namespace App\Services\Chat\Interfaces;

use App\Models\MySql\Chat\ChatMessageImage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ChatMessageImageServiceInterface
 *
 * @package App\Services\Chat\Interfaces
 */
interface ChatMessageImageServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $chatMessageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return ChatMessageImage
     */
    public function createImage(
        string $chatMessageId,
        string $content,
        string $mime,
        string $extension
    ) : ChatMessageImage;

    /**
     * This method provides creating data
     *
     * @param string $chatMessageId
     * @param array $chatMessageImageFiles
     *
     * @return Collection
     */
    public function createImages(
        string $chatMessageId,
        array $chatMessageImageFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param ChatMessageImage $chatMessageImage
     *
     * @return bool
     */
    public function deleteImage(
        ChatMessageImage $chatMessageImage
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $chatMessageImages
     *
     * @return bool
     */
    public function deleteImages(
        Collection $chatMessageImages
    ) : bool;
}
