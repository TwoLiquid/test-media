<?php

namespace App\Transformers\Api\Guest\User;

use App\Models\MySql\User\UserVideo;
use App\Transformers\BaseTransformer;
use League\Fractal\Resource\Item;

/**
 * Class UserVideoTransformer
 *
 * @package App\Transformers\Api\Guest\User
 */
class UserVideoTransformer extends BaseTransformer
{
    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'thumbnail'
    ];

    /**
     * @param UserVideo $userVideo
     *
     * @return array
     */
    public function transform(UserVideo $userVideo) : array
    {
        return [
            'id'         => $userVideo->id,
            'auth_id'    => $userVideo->auth_id,
            'request_id' => $userVideo->request_id,
            'url'        => generateFullStorageLink($userVideo->url),
            'duration'   => $userVideo->duration,
            'mime'       => $userVideo->mime,
            'declined'   => $userVideo->declined,
            'likes'      => $userVideo->likes
        ];
    }

    /**
     * @param UserVideo $userVideo
     *
     * @return Item|null
     */
    public function includeThumbnail(UserVideo $userVideo): ?Item
    {
        $thumbnail = $userVideo->thumbnail;

        return $thumbnail ? $this->item($thumbnail, new UserVideoThumbnailTransformer) : null;
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'user_video';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'user_videos';
    }
}
