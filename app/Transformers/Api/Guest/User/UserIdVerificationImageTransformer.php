<?php

namespace App\Transformers\Api\Guest\User;

use App\Models\MySql\User\UserIdVerificationImage;
use App\Transformers\BaseTransformer;

/**
 * Class UserIdVerificationImageTransformer
 *
 * @package App\Transformers\Api\Guest\User
 */
class UserIdVerificationImageTransformer extends BaseTransformer
{
    /**
     * @param UserIdVerificationImage $userIdVerificationImage
     *
     * @return array
     */
    public function transform(UserIdVerificationImage $userIdVerificationImage) : array
    {
        return [
            'id'         => $userIdVerificationImage->id,
            'auth_id'    => $userIdVerificationImage->auth_id,
            'request_id' => $userIdVerificationImage->request_id,
            'url'        => generateFullStorageLink($userIdVerificationImage->url),
            'url_min'    => generateFullStorageLink(getMinimizedFilePath($userIdVerificationImage->url)),
            'mime'       => $userIdVerificationImage->mime,
            'declined'   => $userIdVerificationImage->declined
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'user_id_verification_image';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'user_id_verification_images';
    }
}
