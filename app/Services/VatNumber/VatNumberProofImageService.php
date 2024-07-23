<?php

namespace App\Services\VatNumber;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\VatNumberProof\VatNumberProofImage;
use App\Repositories\VatNumber\VatNumberProofImageRepository;
use App\Services\File\FileService;
use App\Services\VatNumber\Interfaces\VatNumberProofImageServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class VatNumberProofImageService
 *
 * @package App\Services\VatNumber
 */
final class VatNumberProofImageService extends FileService implements VatNumberProofImageServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'vat_number_proof_images';

    /**
     * @var VatNumberProofImageRepository
     */
    protected VatNumberProofImageRepository $vatNumberProofImageRepository;

    /**
     * VatNumberProofImageService constructor
     */
    public function __construct()
    {
        /** @var VatNumberProofImageRepository vatNumberProofImageRepository */
        $this->vatNumberProofImageRepository = new VatNumberProofImageRepository();
    }

    /**
     * @param string $vatNumberProofId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return VatNumberProofImage
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImage(
        string $vatNumberProofId,
        string $content,
        string $mime,
        string $extension
    ) : VatNumberProofImage
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
         * Creating vat number proof image
         */
        return $this->vatNumberProofImageRepository->store(
            $vatNumberProofId,
            $filePath,
            $mime
        );
    }

    /**
     * @param string $vatNumberProofId
     * @param array $vatNumberProofImageFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImages(
        string $vatNumberProofId,
        array $vatNumberProofImageFiles
    ) : Collection
    {
        /**
         * Preparing a vat number proof images collection
         */
        $vatNumberProofImages = new Collection();

        /** @var array $vatNumberProofImageFile */
        foreach ($vatNumberProofImageFiles as $vatNumberProofImageFile) {

            /**
             * Pushing created vat number proof image to response
             */
            $vatNumberProofImages->push(
                $this->createImage(
                    $vatNumberProofId,
                    $vatNumberProofImageFile['content'],
                    $vatNumberProofImageFile['mime'],
                    $vatNumberProofImageFile['extension']
                )
            );
        }

        return $vatNumberProofImages;
    }

    /**
     * @param VatNumberProofImage $vatNumberProofImage
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        VatNumberProofImage $vatNumberProofImage
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $vatNumberProofImage->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $vatNumberProofImage->url
        );

        /**
         * Deleting vat number proof image
         */
        return $this->vatNumberProofImageRepository->delete(
            $vatNumberProofImage
        );
    }

    /**
     * @param Collection $vatNumberProofImages
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $vatNumberProofImages
    ) : bool
    {
        /** @var VatNumberProofImage $vatNumberProofImage */
        foreach ($vatNumberProofImages as $vatNumberProofImage) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $vatNumberProofImage->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $vatNumberProofImage->url
            );
        }

        /**
         * Deleting vat number proof images
         */
        return $this->vatNumberProofImageRepository->deleteByIds(
            $vatNumberProofImages->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
