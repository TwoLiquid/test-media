<?php

namespace App\Transformers\Api\General\Admin;

use App\Models\MySql\AdminAvatar;
use App\Transformers\BaseTransformer;

/**
 * Class AdminAvatarTransformer
 *
 * @package App\Transformers\Api\General\Admin
 */
class AdminAvatarTransformer extends BaseTransformer
{
    /**
     * @param AdminAvatar $adminAvatar
     *
     * @return array
     */
    public function transform(AdminAvatar $adminAvatar) : array
    {
        return [
            'id'      => $adminAvatar->id,
            'auth_id' => $adminAvatar->auth_id,
            'url'     => generateFullStorageLink($adminAvatar->url),
            'url_min' => generateFullStorageLink(getMinimizedFilePath($adminAvatar->url)),
            'mime'    => $adminAvatar->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'admin_avatar';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'admin_avatars';
    }
}
