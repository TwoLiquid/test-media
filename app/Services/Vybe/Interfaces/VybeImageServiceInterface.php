<?php

namespace App\Services\Vybe\Interfaces;

use App\Models\MySql\Vybe\VybeImage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface VybeImageServiceInterface
 *
 * @package App\Services\Vybe\Interfaces
 */
interface VybeImageServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $content
     * @param string $mime
     * @param string $extension
     * @param bool $main
     *
     * @return VybeImage
     */
    public function createImage(
        string $content,
        string $mime,
        string $extension,
        bool $main
    ) : VybeImage;

    /**
     * This method provides creating data
     *
     * @param array $vybeImageFiles
     *
     * @return Collection
     */
    public function createImages(
        array $vybeImageFiles
    ) : Collection;

    /**
     * This method provides updating data
     *
     * @param Collection $vybeImages
     */
    public function acceptImages(
        Collection $vybeImages
    ) : void;

    /**
     * This method provides updating data
     *
     * @param Collection $vybeImages
     */
    public function declineImages(
        Collection $vybeImages
    ) : void;

    /**
     * This method provides deleting data
     *
     * @param VybeImage $vybeImage
     *
     * @return bool
     */
    public function deleteImage(
        VybeImage $vybeImage
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $vybeImages
     *
     * @return bool
     */
    public function deleteImages(
        Collection $vybeImages
    ) : bool;
}
