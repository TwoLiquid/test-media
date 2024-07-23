<?php

namespace App\Transformers\Api\General\Review;

use App\Transformers\BaseTransformer;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use League\Fractal\Resource\Collection;

/**
 * Class ReviewMessageTransformer
 *
 * @package App\Transformers\Api\General\Review
 */
class ReviewMessageTransformer extends BaseTransformer
{
    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $reviewMessagesImages;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $reviewMessagesVideos;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $usersAvatars;

    /**
     * ReviewMessageTransformer
     *
     * @param EloquentCollection $reviewMessagesImages
     * @param EloquentCollection $reviewMessagesVideos
     * @param EloquentCollection $usersAvatars
     */
    public function __construct(
        EloquentCollection $reviewMessagesImages,
        EloquentCollection $reviewMessagesVideos,
        EloquentCollection $usersAvatars
    )
    {
        $this->reviewMessagesImages = $reviewMessagesImages;
        $this->reviewMessagesVideos = $reviewMessagesVideos;
        $this->usersAvatars = $usersAvatars;
    }

    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'review_message_images',
        'review_message_videos'
    ];

    /**
     * @return array
     */
    public function transform() : array
    {
        return [];
    }

    /**
     * @return Collection|null
     */
    public function includeReviewMessageImages() : ?Collection
    {
        $reviewMessagesImages = $this->reviewMessagesImages;

        return $this->collection($reviewMessagesImages, new ReviewMessageImageTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeReviewMessageVideos() : ?Collection
    {
        $reviewMessagesVideos = $this->reviewMessagesVideos;

        return $this->collection($reviewMessagesVideos, new ReviewMessageVideoTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeUserAvatars() : ?Collection
    {
        $usersAvatars = $this->usersAvatars;

        return $this->collection($usersAvatars, new UserAvatarTransformer);
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'review_message';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'review_messages';
    }
}
