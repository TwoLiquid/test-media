<?php

namespace App\Transformers\Api\General\User\Background;

use App\Models\MySql\User\UserBackground;
use App\Transformers\BaseTransformer;

/**
 * Class UserBackgroundTransformer
 *
 * @package App\Transformers\Api\General\User\Background
 */
class UserBackgroundTransformer extends BaseTransformer
{
    /**
     * @param UserBackground $userBackground
     *
     * @return array
     */
    public function transform(UserBackground $userBackground) : array
    {
        return [
            'id'         => $userBackground->id,
            'auth_id'    => $userBackground->auth_id,
            'request_id' => $userBackground->request_id,
            'url'        => generateFullStorageLink($userBackground->url),
            'url_min'    => generateFullStorageLink(getMinimizedFilePath($userBackground->url)),
            'mime'       => $userBackground->mime,
            'declined'   => $userBackground->declined
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'user_background';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'user_backgrounds';
    }
}
