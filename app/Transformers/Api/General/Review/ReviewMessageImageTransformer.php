<?php

namespace App\Transformers\Api\General\Review;

use App\Models\MySql\Review\ReviewMessageImage;
use App\Transformers\BaseTransformer;

/**
 * Class ReviewMessageImageTransformer
 *
 * @package App\Transformers\Api\General\Review
 */
class ReviewMessageImageTransformer extends BaseTransformer
{
    /**
     * @param ReviewMessageImage $reviewMessageImage
     *
     * @return array
     */
    public function transform(ReviewMessageImage $reviewMessageImage) : array
    {
        return [
            'id'            => $reviewMessageImage->id,
            'message_id'    => $reviewMessageImage->message_id,
            'url' => route('api.review.message.image.download', [
                'id' => $reviewMessageImage->id
            ]),
            'url_min' => route('api.review.message.image.download.min', [
                'id' => $reviewMessageImage->id
            ]),
            'size'          => $reviewMessageImage->size,
            'mime'          => $reviewMessageImage->mime,
            'created_at'    => $reviewMessageImage->created_at
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'review_message_image';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'review_message_images';
    }
}
