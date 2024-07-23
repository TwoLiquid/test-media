<?php

namespace App\Services\Activity\Interfaces;

use App\Models\MySql\ActivityImage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface ActivityImageServiceInterface
 *
 * @package App\Services\Activity\Interfaces
 */
interface ActivityImageServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $activityId
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param string $type
     *
     * @return ActivityImage
     */
    public function createImage(
        string $activityId,
        string $content,
        string $mime,
        string $extension,
        string $type
    ) : ActivityImage;

    /**
     * This method provides creating data
     *
     * @param string $activityId
     * @param array $activityImageFiles
     *
     * @return Collection
     */
    public function createImages(
        string $activityId,
        array $activityImageFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param ActivityImage $activityImage
     *
     * @return bool
     */
    public function deleteImage(
        ActivityImage $activityImage
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $activityImages
     *
     * @return bool
     */
    public function deleteImages(
        Collection $activityImages
    ) : bool;
}
