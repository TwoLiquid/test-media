<?php

namespace App\Services\User\Interfaces;

use App\Models\MySql\User\UserIdVerificationImage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserIdVerificationImageServiceInterface
 *
 * @package App\Services\User\Interfaces
 */
interface UserIdVerificationImageServiceInterface
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
     * @return UserIdVerificationImage
     */
    public function createImage(
        int $authId,
        string $content,
        string $mime,
        string $extension,
        ?string $requestId
    ) : UserIdVerificationImage;

    /**
     * This method provides creating data
     *
     * @param int $authId
     * @param array $userIdVerificationImageFiles
     *
     * @return Collection
     */
    public function createImages(
        int $authId,
        array $userIdVerificationImageFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param UserIdVerificationImage $userIdVerificationImage
     *
     * @return bool
     */
    public function deleteImage(
        UserIdVerificationImage $userIdVerificationImage
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $userIdVerificationImages
     *
     * @return bool
     */
    public function deleteImages(
        Collection $userIdVerificationImages
    ) : bool;
}
