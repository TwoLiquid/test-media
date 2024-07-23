<?php

namespace App\Transformers\Api\General\User\Image;

use App\Models\MySql\User\UserImage;
use App\Transformers\BaseTransformer;

/**
 * Class UserImageTransformer
 *
 * @package App\Transformers\Api\General\User\Image
 */
class UserImageTransformer extends BaseTransformer
{
    /**
     * @param UserImage $userImage
     *
     * @return array
     */
    public function transform(UserImage $userImage) : array
    {
        return [
            'id'         => $userImage->id,
            'auth_id'    => $userImage->auth_id,
            'request_id' => $userImage->request_id,
            'url'        => generateFullStorageLink($userImage->url),
            'url_min'    => generateFullStorageLink(getMinimizedFilePath($userImage->url)),
            'mime'       => $userImage->mime,
            'declined'   => $userImage->declined,
            'likes'      => $userImage->likes
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'user_image';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'user_images';
    }
}
