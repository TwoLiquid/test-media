<?php

namespace App\Services\Alert\Interfaces;

use App\Models\MySql\Alert\AlertImage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface AlertImageServiceInterface
 *
 * @package App\Services\Alert\Interfaces
 */
interface AlertImageServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string|null $alertId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return AlertImage
     */
    public function createImage(
        ?string $alertId,
        string $content,
        string $mime,
        string $extension
    ) : AlertImage;

    /**
     * This method provides creating data
     *
     * @param string $alertId
     * @param array $alertImageFiles
     *
     * @return Collection
     */
    public function createImages(
        string $alertId,
        array $alertImageFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param AlertImage $alertImage
     *
     * @return bool
     */
    public function deleteImage(
        AlertImage $alertImage
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $alertImages
     *
     * @return bool
     */
    public function deleteImages(
        Collection $alertImages
    ) : bool;

    /**
     * This method provides creating data
     */
    public function importResourceImages() : void;
}
