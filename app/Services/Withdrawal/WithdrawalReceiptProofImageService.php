<?php

namespace App\Services\Withdrawal;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\WithdrawalReceiptProof\WithdrawalReceiptProofImage;
use App\Repositories\Withdrawal\WithdrawalReceiptProofImageRepository;
use App\Services\File\FileService;
use App\Services\Withdrawal\Interfaces\WithdrawalReceiptProofImageServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class WithdrawalReceiptProofImageService
 *
 * @package App\Services\WithdrawalReceiptProof
 */
final class WithdrawalReceiptProofImageService extends FileService implements WithdrawalReceiptProofImageServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'withdrawal_receipt_proof_images';

    /**
     * @var WithdrawalReceiptProofImageRepository
     */
    protected WithdrawalReceiptProofImageRepository $withdrawalReceiptProofImageRepository;

    /**
     * WithdrawalReceiptProofImageService constructor
     */
    public function __construct()
    {
        /** @var WithdrawalReceiptProofImageRepository withdrawalReceiptProofImageRepository */
        $this->withdrawalReceiptProofImageRepository = new WithdrawalReceiptProofImageRepository();
    }

    /**
     * @param string $receiptId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return WithdrawalReceiptProofImage
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImage(
        string $receiptId,
        string $content,
        string $mime,
        string $extension
    ) : WithdrawalReceiptProofImage
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
         * Creating withdrawal receipt proof image
         */
        return $this->withdrawalReceiptProofImageRepository->store(
            $receiptId,
            $filePath,
            $mime
        );
    }

    /**
     * @param string $receiptId
     * @param array $withdrawalReceiptProofImageFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImages(
        string $receiptId,
        array $withdrawalReceiptProofImageFiles
    ) : Collection
    {
        /**
         * Preparing a withdrawal receipt proof images collection
         */
        $withdrawalReceiptProofImages = new Collection();

        /** @var array $withdrawalReceiptProofImageFile */
        foreach ($withdrawalReceiptProofImageFiles as $withdrawalReceiptProofImageFile) {

            /**
             * Pushing created withdrawal receipt proof image to response
             */
            $withdrawalReceiptProofImages->push(
                $this->createImage(
                    $receiptId,
                    $withdrawalReceiptProofImageFile['content'],
                    $withdrawalReceiptProofImageFile['mime'],
                    $withdrawalReceiptProofImageFile['extension']
                )
            );
        }

        return $withdrawalReceiptProofImages;
    }

    /**
     * @param WithdrawalReceiptProofImage $withdrawalReceiptProofImage
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        WithdrawalReceiptProofImage $withdrawalReceiptProofImage
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $withdrawalReceiptProofImage->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $withdrawalReceiptProofImage->url
        );

        /**
         * Deleting withdrawal receipt proof image
         */
        return $this->withdrawalReceiptProofImageRepository->delete(
            $withdrawalReceiptProofImage
        );
    }

    /**
     * @param Collection $withdrawalReceiptProofImages
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $withdrawalReceiptProofImages
    ) : bool
    {
        /** @var WithdrawalReceiptProofImage $withdrawalReceiptProofImage */
        foreach ($withdrawalReceiptProofImages as $withdrawalReceiptProofImage) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $withdrawalReceiptProofImage->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $withdrawalReceiptProofImage->url
            );
        }

        /**
         * Deleting withdrawal receipt proof images
         */
        return $this->withdrawalReceiptProofImageRepository->deleteByIds(
            $withdrawalReceiptProofImages->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
