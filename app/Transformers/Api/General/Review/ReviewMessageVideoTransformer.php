<?php

namespace App\Transformers\Api\General\Review;

use App\Models\MySql\Review\ReviewMessageVideo;
use App\Transformers\BaseTransformer;
use League\Fractal\Resource\Item;

/**
 * Class ReviewMessageVideoTransformer
 *
 * @package App\Transformers\Api\General\Review
 */
class ReviewMessageVideoTransformer extends BaseTransformer
{
    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'thumbnail'
    ];

    /**
     * @param ReviewMessageVideo $reviewMessageVideo
     *
     * @return array
     */
    public function transform(ReviewMessageVideo $reviewMessageVideo) : array
    {
        return [
            'id'            => $reviewMessageVideo->id,
            'message_id'    => $reviewMessageVideo->message_id,
            'url' => route('api.review.message.video.download', [
                'id' => $reviewMessageVideo->id
            ]),
            'duration'      => $reviewMessageVideo->duration,
            'size'          => $reviewMessageVideo->size,
            'mime'          => $reviewMessageVideo->mime,
            'created_at'    => $reviewMessageVideo->created_at
        ];
    }

    /**
     * @param ReviewMessageVideo $reviewMessageVideo
     *
     * @return Item|null
     */
    public function includeThumbnail(ReviewMessageVideo $reviewMessageVideo): ?Item
    {
        $thumbnail = $reviewMessageVideo->thumbnail;

        return $thumbnail ? $this->item($thumbnail, new ReviewMessageVideoThumbnailTransformer) : null;
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'review_message_video';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'review_message_videos';
    }
}
