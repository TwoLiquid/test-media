<?php

namespace App\Transformers\Api\Guest\User;

use App\Models\MySql\User\UserAvatar;
use App\Transformers\BaseTransformer;

/**
 * Class UserAvatarTransformer
 *
 * @package App\Transformers\Api\Guest\User
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
            'id'         => $userAvatar->id,
            'auth_id'    => $userAvatar->auth_id,
            'request_id' => $userAvatar->request_id,
            'url'        => generateFullStorageLink($userAvatar->url),
            'url_min'    => generateFullStorageLink(getMinimizedFilePath($userAvatar->url)),
            'mime'       => $userAvatar->mime,
            'declined'   => $userAvatar->declined
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
