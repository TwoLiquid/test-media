<?php

namespace App\Transformers\Api\Guest\Payment;

use App\Models\MySql\PaymentMethodImage;
use App\Transformers\BaseTransformer;

/**
 * Class PaymentMethodImageTransformer
 *
 * @package App\Transformers\Api\Guest\Payment
 */
class PaymentMethodImageTransformer extends BaseTransformer
{
    /**
     * @param PaymentMethodImage $paymentMethodImage
     *
     * @return array
     */
    public function transform(PaymentMethodImage $paymentMethodImage) : array
    {
        return [
            'id'        => $paymentMethodImage->id,
            'method_id' => $paymentMethodImage->method_id,
            'url'       => generateFullStorageLink($paymentMethodImage->url),
            'url_min'   => generateFullStorageLink(getMinimizedFilePath($paymentMethodImage->url)),
            'mime'      => $paymentMethodImage->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'payment_method_image';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'payment_method_images';
    }
}
