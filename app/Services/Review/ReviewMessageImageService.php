<?php

namespace App\Services\Review;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Review\ReviewMessageImage;
use App\Repositories\Review\ReviewMessageImageRepository;
use App\Services\File\FileService;
use App\Services\Review\Interfaces\ReviewMessageImageServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ReviewMessageImageService
 *
 * @package App\Services\Review
 */
final class ReviewMessageImageService extends FileService implements ReviewMessageImageServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'review_message_images';

    /**
     * @var ReviewMessageImageRepository
     */
    protected ReviewMessageImageRepository $reviewMessageImageRepository;

    /**
     * ReviewMessageImageService constructor
     */
    public function __construct()
    {
        /** @var ReviewMessageImageRepository reviewMessageImageRepository */
        $this->reviewMessageImageRepository = new ReviewMessageImageRepository();
    }

    /**
     * @param string $messageId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return ReviewMessageImage
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImage(
        string $messageId,
        string $content,
        string $mime,
        string $extension
    ) : ReviewMessageImage
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
         * Creating review message image
         */
        return $this->reviewMessageImageRepository->store(
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
         * Preparing a review message images collection
         */
        $reviewMessageImages = new Collection();

        /** @var array $imageFile */
        foreach ($imageFiles as $imageFile) {

            /**
             * Pushing created review message image to response
             */
            $reviewMessageImages->push(
                $this->createImage(
                    $messageId,
                    $imageFile['content'],
                    $imageFile['mime'],
                    $imageFile['extension']
                )
            );
        }

        return $reviewMessageImages;
    }

    /**
     * @param ReviewMessageImage $reviewMessageImage
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        ReviewMessageImage $reviewMessageImage
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $reviewMessageImage->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $reviewMessageImage->url
        );

        /**
         * Deleting review message image
         */
        return $this->reviewMessageImageRepository->delete(
            $reviewMessageImage
        );
    }

    /**
     * @param Collection $reviewMessageImages
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $reviewMessageImages
    ) : bool
    {
        /** @var ReviewMessageImage $reviewMessageImage */
        foreach ($reviewMessageImages as $reviewMessageImage) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $reviewMessageImage->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $reviewMessageImage->url
            );
        }

        /**
         * Deleting review message images
         */
        return $this->reviewMessageImageRepository->deleteByIds(
            $reviewMessageImages->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
