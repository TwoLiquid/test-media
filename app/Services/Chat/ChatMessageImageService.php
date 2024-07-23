<?php

namespace App\Services\Chat;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Chat\ChatMessageImage;
use App\Repositories\Chat\ChatMessageImageRepository;
use App\Services\Chat\Interfaces\ChatMessageImageServiceInterface;
use App\Services\File\FileService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ChatMessageImageService
 *
 * @package App\Services\Chat
 */
final class ChatMessageImageService extends FileService implements ChatMessageImageServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'private';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'chat_message_images';

    /**
     * @var ChatMessageImageRepository
     */
    protected ChatMessageImageRepository $chatMessageImageRepository;

    /**
     * ChatMessageImageService constructor
     */
    public function __construct()
    {
        /** @var ChatMessageImageRepository chatMessageImageRepository */
        $this->chatMessageImageRepository = new ChatMessageImageRepository();
    }

    /**
     * @param string $chatMessageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return ChatMessageImage
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImage(
        string $chatMessageId,
        string $content,
        string $mime,
        string $extension
    ) : ChatMessageImage
    {
        /**
         * Uploading file
         */
        $filePath = $this->uploadFile(
            $content,
            $extension,
            self::FOLDER
        );

        /**
         * Creating thumbnail file
         */
        $this->createImageThumbnailFile(
            $filePath
        );

        /**
         * Getting file size
         */
        $size = $this->getFileSize(
            $filePath
        );

        /**
         * Creating chat message image
         */
        return $this->chatMessageImageRepository->store(
            $chatMessageId,
            $filePath,
            $size,
            $mime
        );
    }

    /**
     * @param string $chatMessageId
     * @param array $chatMessageImageFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImages(
        string $chatMessageId,
        array $chatMessageImageFiles
    ) : Collection
    {
        /**
         * Preparing a chat message images collection
         */
        $chatMessageImages = new Collection();

        /** @var array $chatMessageImageFile */
        foreach ($chatMessageImageFiles as $chatMessageImageFile) {

            /**
             * Pushing created chat message image to response
             */
            $chatMessageImages->push(
                $this->createImage(
                    $chatMessageId,
                    $chatMessageImageFile['content'],
                    $chatMessageImageFile['mime'],
                    $chatMessageImageFile['extension']
                )
            );
        }

        return $chatMessageImages;
    }

    /**
     * @param ChatMessageImage $chatMessageImage
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        ChatMessageImage $chatMessageImage
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $chatMessageImage->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $chatMessageImage->url
        );

        /**
         * Deleting chat message image
         */
        return $this->chatMessageImageRepository->delete(
            $chatMessageImage
        );
    }

    /**
     * @param Collection $chatMessageImages
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $chatMessageImages
    ) : bool
    {
        /** @var ChatMessageImage $chatMessageImage */
        foreach ($chatMessageImages as $chatMessageImage) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $chatMessageImage->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $chatMessageImage->url
            );
        }

        /**
         * Deleting chat message images
         */
        return $this->chatMessageImageRepository->deleteByIds(
            $chatMessageImages->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
