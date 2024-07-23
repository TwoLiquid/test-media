<?php

namespace App\Transformers\Api\Guest\User;

use App\Models\MySql\User\UserVideoThumbnail;
use App\Transformers\BaseTransformer;

/**
 * Class UserVideoThumbnailTransformer
 *
 * @package App\Transformers\Api\Guest\User
 */
class UserVideoThumbnailTransformer extends BaseTransformer
{
    /**
     * @param UserVideoThumbnail $userVideoThumbnail
     *
     * @return array
     */
    public function transform(UserVideoThumbnail $userVideoThumbnail) : array
    {
        return [
            'id'       => $userVideoThumbnail->id,
            'video_id' => $userVideoThumbnail->video_id,
            'url'      => generateFullStorageLink($userVideoThumbnail->url),
            'url_min'  => generateFullStorageLink(getMinimizedFilePath($userVideoThumbnail->url)),
            'mime'     => $userVideoThumbnail->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'user_video_thumbnail';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'user_video_thumbnails';
    }
}
