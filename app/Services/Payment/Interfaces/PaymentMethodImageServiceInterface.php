<?php

namespace App\Services\Payment\Interfaces;

use App\Models\MySql\PaymentMethodImage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface PaymentMethodImageServiceInterface
 *
 * @package App\Services\Payment\Interfaces
 */
interface PaymentMethodImageServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $paymentMethodId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return PaymentMethodImage
     */
    public function createImage(
        string $paymentMethodId,
        string $content,
        string $mime,
        string $extension
    ) : PaymentMethodImage;

    /**
     * This method provides creating data
     *
     * @param string $paymentMethodId
     * @param array $paymentMethodImageFiles
     *
     * @return Collection
     */
    public function createImages(
        string $paymentMethodId,
        array $paymentMethodImageFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param PaymentMethodImage $paymentMethodImage
     *
     * @return bool
     */
    public function deleteImage(
        PaymentMethodImage $paymentMethodImage
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $paymentMethodImages
     *
     * @return bool
     */
    public function deleteImages(
        Collection $paymentMethodImages
    ) : bool;
}
