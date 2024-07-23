<?php

namespace App\Services\Admin\Interfaces;

use App\Models\MySql\AdminAvatar;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface AdminAvatarServiceInterface
 *
 * @package App\Services\Admin\Interfaces
 */
interface AdminAvatarServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $authId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return AdminAvatar
     */
    public function createAvatar(
        string $authId,
        string $content,
        string $mime,
        string $extension
    ) : AdminAvatar;

    /**
     * This method provides deleting data
     *
     * @param AdminAvatar $adminAvatar
     *
     * @return bool
     */
    public function deleteAvatar(
        AdminAvatar $adminAvatar
    ) : bool;

    /**
    This method provides deleting data
     *
     * @param Collection $adminAvatars
     *
     * @return bool
     */
    public function deleteAvatars(
        Collection $adminAvatars
    ) : bool;
}
