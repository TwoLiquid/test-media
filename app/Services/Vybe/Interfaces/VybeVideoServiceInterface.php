<?php

namespace App\Services\Vybe\Interfaces;

use App\Models\MySql\Vybe\VybeVideo;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface VybeVideoServiceInterface
 *
 * @package App\Services\Vybe\Interfaces
 */
interface VybeVideoServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param bool $main
     *
     * @return VybeVideo
     */
    public function createVideo(
        string $content,
        string $mime,
        string $extension,
        bool $main
    ) : VybeVideo;

    /**
     * This method provides creating data
     *
     * @param array $vybeVideoFiles
     *
     * @return Collection
     */
    public function createVideos(
        array $vybeVideoFiles
    ) : Collection;

    /**
     * This method provides updating data
     *
     * @param Collection $vybeVideos
     */
    public function acceptVideos(
        Collection $vybeVideos
    ) : void;

    /**
     * This method provides updating data
     *
     * @param Collection $vybeVideos
     */
    public function declineVideos(
        Collection $vybeVideos
    ) : void;

    /**
     * This method provides deleting data
     *
     * @param VybeVideo $vybeVideo
     *
     * @return bool
     */
    public function deleteVideo(
        VybeVideo $vybeVideo
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $vybeVideos
     *
     * @return bool
     */
    public function deleteVideos(
        Collection $vybeVideos
    ) : bool;
}
