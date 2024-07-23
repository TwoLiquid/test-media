<?php

namespace App\Services\Support;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Support\SupportTicketMessageImage;
use App\Repositories\Support\SupportTicketMessageImageRepository;
use App\Services\File\FileService;
use App\Services\Support\Interfaces\SupportTicketMessageImageServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SupportTicketMessageImageService
 *
 * @package App\Services\Support
 */
final class SupportTicketMessageImageService extends FileService implements SupportTicketMessageImageServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'private';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'support_ticket_message_images';

    /**
     * @var SupportTicketMessageImageRepository
     */
    protected SupportTicketMessageImageRepository $supportTicketMessageImageRepository;

    /**
     * SupportTicketMessageImageService constructor
     */
    public function __construct()
    {
        /** @var SupportTicketMessageImageRepository supportTicketMessageImageRepository */
        $this->supportTicketMessageImageRepository = new SupportTicketMessageImageRepository();
    }

    /**
     * @param string $messageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return SupportTicketMessageImage
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImage(
        string $messageId,
        string $content,
        string $mime,
        string $extension
    ) : SupportTicketMessageImage
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
         * Creating support ticket message image
         */
        return $this->supportTicketMessageImageRepository->store(
            $messageId,
            $filePath,
            $size,
            $mime
        );
    }

    /**
     * @param string $messageId
     * @param array $imageFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImages(
        string $messageId,
        array $imageFiles
    ) : Collection
    {
        /**
         * Preparing a support ticket message images collection
         */
        $supportTicketMessageImages = new Collection();

        /** @var array $imageFile */
        foreach ($imageFiles as $imageFile) {

            /**
             * Pushing created support ticket message image to response
             */
            $supportTicketMessageImages->push(
                $this->createImage(
                    $messageId,
                    $imageFile['content'],
                    $imageFile['mime'],
                    $imageFile['extension']
                )
            );
        }

        return $supportTicketMessageImages;
    }

    /**
     * @param SupportTicketMessageImage $supportTicketMessageImage
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        SupportTicketMessageImage $supportTicketMessageImage
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $supportTicketMessageImage->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $supportTicketMessageImage->url
        );

        /**
         * Deleting support ticket message image
         */
        return $this->supportTicketMessageImageRepository->delete(
            $supportTicketMessageImage
        );
    }

    /**
     * @param Collection $supportTicketMessageImages
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $supportTicketMessageImages
    ) : bool
    {
        /** @var SupportTicketMessageImage $supportTicketMessageImage */
        foreach ($supportTicketMessageImages as $supportTicketMessageImage) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $supportTicketMessageImage->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $supportTicketMessageImage->url
            );
        }

        /**
         * Deleting support ticket message images
         */
        return $this->supportTicketMessageImageRepository->deleteByIds(
            $supportTicketMessageImages->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
