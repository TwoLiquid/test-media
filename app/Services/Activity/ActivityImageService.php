<?php

namespace App\Services\Activity;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\ActivityImage;
use App\Repositories\Activity\ActivityImageRepository;
use App\Services\Activity\Interfaces\ActivityImageServiceInterface;
use App\Services\File\FileService;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ActivityImageService
 *
 * @package App\Services\Activity
 */
final class ActivityImageService extends FileService implements ActivityImageServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'activity_images';

    /**
     * @var ActivityImageRepository
     */
    protected ActivityImageRepository $activityImageRepository;

    /**
     * ActivityImageService constructor
     */
    public function __construct()
    {
        /** @var ActivityImageRepository activityImageRepository */
        $this->activityImageRepository = new ActivityImageRepository();
    }

    /**
     * @param string $activityId
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param string $type
     *
     * @return ActivityImage
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImage(
        string $activityId,
        string $content,
        string $mime,
        string $extension,
        string $type
    ) : ActivityImage
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
         * Creating activity image
         */
        return $this->activityImageRepository->store(
            $activityId,
            $type,
            $filePath,
            $mime
        );
    }

    /**
     * @param string $activityId
     * @param array $activityImageFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImages(
        string $activityId,
        array $activityImageFiles
    ) : Collection
    {
        /**
         * Preparing an activity images collection
         */
        $activityImages = new Collection();

        /** @var array $activityImageFile */
        foreach ($activityImageFiles as $activityImageFile) {

            /**
             * Pushing created activity image to response
             */
            $activityImages->push(
                $this->createImage(
                    $activityId,
                    $activityImageFile['content'],
                    $activityImageFile['mime'],
                    $activityImageFile['extension'],
                    $activityImageFile['type']
                )
            );
        }

        return $activityImages;
    }

    /**
     * @param ActivityImage $activityImage
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        ActivityImage $activityImage
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $activityImage->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $activityImage->url
        );

        /**
         * Deleting activity image
         */
        return $this->activityImageRepository->delete(
            $activityImage
        );
    }

    /**
     * @param Collection $activityImages
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $activityImages
    ) : bool
    {
        /** @var ActivityImage $activityImage */
        foreach ($activityImages as $activityImage) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $activityImage->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $activityImage->url
            );
        }

        /**
         * Deleting activity images
         */
        return $this->activityImageRepository->deleteByIds(
            $activityImages->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
