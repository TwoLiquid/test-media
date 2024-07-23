<?php

namespace App\Services\Vybe;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Vybe\VybeImage;
use App\Repositories\Vybe\VybeImageRepository;
use App\Services\File\FileService;
use App\Services\Vybe\Interfaces\VybeImageServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class VybeImageService
 *
 * @package App\Services\Vybe
 */
final class VybeImageService extends FileService implements VybeImageServiceInterface
{
    /**
     * Storage disk environment
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'vybe_images';

    /**
     * @var VybeImageRepository
     */
    protected VybeImageRepository $vybeImageRepository;

    /**
     * VybeImageService constructor
     */
    public function __construct()
    {
        /** @var VybeImageRepository vybeImageRepository */
        $this->vybeImageRepository = new VybeImageRepository();
    }

    /**
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param bool $main
     *
     * @return VybeImage
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImage(
        string $content,
        string $mime,
        string $extension,
        bool $main = false
    ) : VybeImage
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
         * Creating vybe image
         */
        return $this->vybeImageRepository->store(
            $filePath,
            $mime,
            $main
        );
    }

    /**
     * @param array $vybeImageFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImages(
        array $vybeImageFiles
    ) : Collection
    {
        /**
         * Preparing vybe images collection
         */
        $vybeImages = new Collection();

        /** @var array $vybeImageFile */
        foreach ($vybeImageFiles as $vybeImageFile) {

            /**
             * Pushing created vybe image to response
             */
            $vybeImages->push(
                $this->createImage(
                    $vybeImageFile['content'],
                    $vybeImageFile['mime'],
                    $vybeImageFile['extension'],
                    $vybeImageFile['main'] ?? false
                )
            );
        }

        return $vybeImages;
    }

    /**
     * @param Collection $vybeImages
     *
     * @throws DatabaseException
     */
    public function acceptImages(
        Collection $vybeImages
    ) : void
    {
        /** @var VybeImage $vybeImage */
        foreach ($vybeImages as $vybeImage) {

            /**
             * Updating vybe image
             */
            $this->vybeImageRepository->accept(
                $vybeImage
            );
        }
    }

    /**
     * @param Collection $vybeImages
     *
     * @throws DatabaseException
     */
    public function declineImages(
        Collection $vybeImages
    ) : void
    {
        /** @var VybeImage $vybeImage */
        foreach ($vybeImages as $vybeImage) {

            /**
             * Updating vybe image
             */
            $this->vybeImageRepository->decline(
                $vybeImage
            );
        }
    }

    /**
     * @param VybeImage $vybeImage
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        VybeImage $vybeImage
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $vybeImage->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $vybeImage->url
        );

        /**
         * Deleting vybe image
         */
        return $this->vybeImageRepository->delete(
            $vybeImage
        );
    }

    /**
     * @param Collection $vybeImages
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $vybeImages
    ) : bool
    {
        /** @var VybeImage $vybeImage */
        foreach ($vybeImages as $vybeImage) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $vybeImage->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $vybeImage->url
            );
        }

        /**
         * Deleting vybe images
         */
        return $this->vybeImageRepository->deleteByIds(
            $vybeImages->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
