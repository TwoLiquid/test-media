<?php

namespace App\Services\Payment;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Models\MySql\PaymentMethodImage;
use App\Repositories\Payment\PaymentMethodImageRepository;
use App\Services\File\FileService;
use App\Services\Payment\Interfaces\PaymentMethodImageServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class PaymentMethodImageService
 *
 * @package App\Services\Payment
 */
final class PaymentMethodImageService extends FileService implements PaymentMethodImageServiceInterface
{
    /**
     * @var string
     */
    protected const ENVIRONMENT = 'public';

    /**
     * Image files storage name
     */
    protected const FOLDER = 'payment_method_images';

    /**
     * @var PaymentMethodImageRepository
     */
    protected PaymentMethodImageRepository $paymentMethodImageRepository;

    /**
     * PaymentMethodImageService constructor
     */
    public function __construct()
    {
        /** @var PaymentMethodImageRepository paymentMethodImageRepository */
        $this->paymentMethodImageRepository = new PaymentMethodImageRepository();
    }

    /**
     * @param string $paymentMethodId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return PaymentMethodImage
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImage(
        string $paymentMethodId,
        string $content,
        string $mime,
        string $extension
    ) : PaymentMethodImage
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
         * Creating payment method image
         */
        return $this->paymentMethodImageRepository->store(
            $paymentMethodId,
            $filePath,
            $mime
        );
    }

    /**
     * @param string $paymentMethodId
     * @param array $paymentMethodImageFiles
     *
     * @return Collection
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function createImages(
        string $paymentMethodId,
        array $paymentMethodImageFiles
    ) : Collection
    {
        /**
         * Preparing a payment method images collection
         */
        $paymentMethodImages = new Collection();

        /** @var array $paymentMethodImageFile */
        foreach ($paymentMethodImageFiles as $paymentMethodImageFile) {

            /**
             * Pushing created payment method image to response
             */
            $paymentMethodImages->push(
                $this->createImage(
                    $paymentMethodId,
                    $paymentMethodImageFile['content'],
                    $paymentMethodImageFile['mime'],
                    $paymentMethodImageFile['extension']
                )
            );
        }

        return $paymentMethodImages;
    }

    /**
     * @param PaymentMethodImage $paymentMethodImage
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImage(
        PaymentMethodImage $paymentMethodImage
    ) : bool
    {
        /**
         * Deleting file from storage
         */
        $this->deleteFile(
            $paymentMethodImage->url
        );

        /**
         * Deleting thumbnail file from storage
         */
        $this->deleteImageThumbnailFile(
            $paymentMethodImage->url
        );

        /**
         * Deleting payment method image
         */
        return $this->paymentMethodImageRepository->delete(
            $paymentMethodImage
        );
    }

    /**
     * @param Collection $paymentMethodImages
     *
     * @return bool
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function deleteImages(
        Collection $paymentMethodImages
    ) : bool
    {
        /** @var PaymentMethodImage $paymentMethodImage */
        foreach ($paymentMethodImages as $paymentMethodImage) {

            /**
             * Deleting file from storage
             */
            $this->deleteFile(
                $paymentMethodImage->url
            );

            /**
             * Deleting thumbnail file from storage
             */
            $this->deleteImageThumbnailFile(
                $paymentMethodImage->url
            );
        }

        /**
         * Deleting payment method images
         */
        return $this->paymentMethodImageRepository->deleteByIds(
            $paymentMethodImages->pluck('id')
                ->values()
                ->toArray()
        );
    }
}
