<?php

namespace App\Transformers\Api\General\Review;

use App\Models\MySql\User\UserAvatar;
use App\Transformers\BaseTransformer;

/**
 * Class UserAvatarTransformer
 *
 * @package App\Transformers\Api\General\Chat
 */
class UserAvatarTransformer extends BaseTransformer
{
    /**
     * @param UserAvatar $userAvatar
     *
     * @return array
     */
    public function transform(UserAvatar $userAvatar) : array
    {
        return [
            'id'            => $userAvatar->id,
            'auth_id'       => $userAvatar->auth_id,
            'request_id'    => $userAvatar->request_id,
//            'url'           => $userAvatar->local_url ? generateFullStorageLink($userAvatar->url) : $userAvatar->url,
//            'url_min'       => generateFullStorageLink(getMinimizesFilePath($userAvatar->url)),
            'mime'          => $userAvatar->mime,
            'declined'      => $userAvatar->declined
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'user_avatar';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'user_avatars';
    }
}
