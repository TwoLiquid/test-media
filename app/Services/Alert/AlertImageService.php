<?php

namespace App\Services\Alert;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\Alert\AlertImage;
use App\Repositories\Alert\AlertImageRepository;
use App\Services\Alert\Interfaces\AlertImageServiceInterface;
use App\Services\File\FileService;
use Illuminate\Database\Eloquent\Collection;
use File;

/**
 * Class AlertImageService
 *
 * @package App\Services\Alert
 */
final class AlertImageService extends FileService implements AlertImageServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'alert_images';

    /**
     * @var AlertImageRepository
     */
    protected AlertImageRepository $alertImageRepository;

    /**
     * AlertImageService constructor
     */
    public function __construct()
    {
        /** @var AlertImageRepository alertImageRepository */
        $this->alertImageRepository = new AlertImageRepository();
    }

    /**
     * @param string|null $alertId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return AlertImage
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImage(
        ?string $alertId,
        string $content,
        string $mime,
        string $extension
    ) : AlertImage
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
         * Creating alert image
         */
        return $this->alertImageRepository->store(
            $alertId,
            $filePath,
            $mime
        );
    }

    /**
     * @param string $alertId
     * @param array $alertImageFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImages(
        string $alertId,
        array $alertImageFiles
    ) : Collection
    {
        /**
         * Preparing an alert images collection
         */
        $alertImages = new Collection();

        /** @var array $alertImageFile */
        foreach ($alertImageFiles as $alertImageFile) {

            /**
             * Pushing created alert image to response
             */
            $alertImages->push(
                $this->createImage(
                    $alertId,
                    $alertImageFile['content'],
                    $alertImageFile['mime'],
                    $alertImageFile['extension']
                )
            );
        }

        return $alertImages;
    }

    /**
     * @param AlertImage $alertImage
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        AlertImage $alertImage
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $alertImage->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $alertImage->url
        );

        /**
         * Deleting alert image
         */
        return $this->alertImageRepository->delete(
            $alertImage
        );
    }

    /**
     * @param Collection $alertImages
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $alertImages
    ) : bool
    {
        /** @var AlertImage $alertImage */
        foreach ($alertImages as $alertImage) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $alertImage->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $alertImage->url
            );
        }

        /**
         * Deleting alert images
         */
        return $this->alertImageRepository->deleteByIds(
            $alertImages->pluck('id')
                ->values()
                ->toArray()
        );
    }

    /**
     * @throws BaseException
     * @throws DatabaseException
     */
    public function importResourceImages() : void
    {
        /**
         * Getting alert image files
         */
        $alertImageFiles = File::allFiles(
            resource_path('media/')
        );

        /**
         * Creating resource alert image files
         */
        foreach ($alertImageFiles as $alertImageFile) {
            $this->createImage(
                null,
                base64_encode(file_get_contents($alertImageFile)),
                'image/png',
                'png'
            );
        }
    }
}
