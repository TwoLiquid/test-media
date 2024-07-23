<?php

namespace App\Transformers\Api\General\Review;

use App\Models\MySql\Review\ReviewMessageVideoThumbnail;
use App\Transformers\BaseTransformer;

/**
 * Class ReviewMessageVideoThumbnailTransformer
 *
 * @package App\Transformers\Api\General\Review
 */
class ReviewMessageVideoThumbnailTransformer extends BaseTransformer
{
    /**
     * @param ReviewMessageVideoThumbnail $reviewMessageVideoThumbnail
     *
     * @return array
     */
    public function transform(ReviewMessageVideoThumbnail $reviewMessageVideoThumbnail) : array
    {
        return [
            'id'  => $reviewMessageVideoThumbnail->id,
            'url' => route('api.review.message.video.thumbnail.download', [
                'id' => $reviewMessageVideoThumbnail->id
            ]),
            'url_min' => route('api.review.message.video.thumbnail.download.min', [
                'id' => $reviewMessageVideoThumbnail->id
            ]),
            'mime' => $reviewMessageVideoThumbnail->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'review_message_video_thumbnail';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'review_message_video_thumbnails';
    }
}
