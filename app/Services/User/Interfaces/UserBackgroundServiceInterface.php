<?php

namespace App\Services\User\Interfaces;

use App\Models\MySql\User\UserBackground;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface UserBackgroundServiceInterface
 *
 * @package App\Services\User\Interfaces
 */
interface UserBackgroundServiceInterface
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
     * @return UserBackground
     */
    public function createImage(
        int $authId,
        string $content,
        string $mime,
        string $extension,
        ?string $requestId
    ) : UserBackground;

    /**
     * This method provides creating data
     *
     * @param int $authId
     * @param array $userBackgroundFiles
     *
     * @return Collection
     */
    public function createImages(
        int $authId,
        array $userBackgroundFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param UserBackground $userBackground
     *
     * @return bool
     */
    public function deleteImage(
        UserBackground $userBackground
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $userBackgrounds
     *
     * @return bool
     */
    public function deleteImages(
        Collection $userBackgrounds
    ) : bool;
}
