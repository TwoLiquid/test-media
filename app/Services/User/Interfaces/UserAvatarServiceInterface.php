<?php

namespace App\Services\User\Interfaces;

use App\Models\MySql\User\UserAvatar;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserAvatarServiceInterface
 *
 * @package App\Services\User\Interfaces
 */
interface UserAvatarServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param int $authId
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param string|null $requestId
     *
     * @return UserAvatar
     */
    public function createImage(
        int $authId,
        string $content,
        string $mime,
        string $extension,
        ?string $requestId
    ) : UserAvatar;

    /**
     * This method provides creating data
     *
     * @param int $authId
     * @param array $userAvatarFiles
     *
     * @return Collection
     */
    public function createImages(
        int $authId,
        array $userAvatarFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param UserAvatar $userAvatar
     *
     * @return bool
     */
    public function deleteImage(
        UserAvatar $userAvatar
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $userAvatars
     *
     * @return bool
     */
    public function deleteImages(
        Collection $userAvatars
    ) : bool;
}
