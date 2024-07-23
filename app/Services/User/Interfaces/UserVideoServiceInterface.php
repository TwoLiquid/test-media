<?php

namespace App\Services\User\Interfaces;

use App\Models\MySql\User\UserVideo;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface VideoServiceInterface
 *
 * @package App\Services\User\Interfaces
 */
interface UserVideoServiceInterface
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
     * @return UserVideo
     */
    public function createVideo(
        int $authId,
        string $content,
        string $mime,
        string $extension,
        ?string $requestId
    ) : UserVideo;

    /**
     * This method provides creating data
     *
     * @param int $authId
     * @param array $userVideoFiles
     *
     * @return Collection
     */
    public function createVideos(
        int $authId,
        array $userVideoFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param UserVideo $userVideo
     *
     * @return bool
     */
    public function deleteVideo(
        UserVideo $userVideo
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $userVideos
     *
     * @return bool
     */
    public function deleteVideos(
        Collection $userVideos
    ) : bool;
}
