<?php

namespace App\Services\User\Interfaces;

use App\Models\MySql\User\UserImage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserImageServiceInterface
 *
 * @package App\Services\User\Interfaces
 */
interface UserImageServiceInterface
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
     * @return UserImage
     */
    public function createImage(
        int $authId,
        string $content,
        string $mime,
        string $extension,
        ?string $requestId
    ) : UserImage;

    /**
     * This method provides creating data
     *
     * @param int $authId
     * @param array $userImageFiles
     *
     * @return Collection
     */
    public function createImages(
        int $authId,
        array $userImageFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param UserImage $userImage
     *
     * @return bool
     */
    public function deleteImage(
        UserImage $userImage
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $userImages
     *
     * @return bool
     */
    public function deleteImages(
        Collection $userImages
    ) : bool;
}
