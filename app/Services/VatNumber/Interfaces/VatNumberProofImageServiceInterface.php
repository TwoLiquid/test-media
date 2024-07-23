<?php

namespace App\Services\VatNumber\Interfaces;

use App\Models\MySql\VatNumberProof\VatNumberProofImage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface VatNumberProofImageServiceInterface
 *
 * @package App\Services\VatNumber\Interfaces
 */
interface VatNumberProofImageServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $vatNumberProofId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return VatNumberProofImage
     */
    public function createImage(
        string $vatNumberProofId,
        string $content,
        string $mime,
        string $extension
    ) : VatNumberProofImage;

    /**
     * This method provides creating data
     *
     * @param string $vatNumberProofId
     * @param array $vatNumberProofImageFiles
     *
     * @return Collection
     */
    public function createImages(
        string $vatNumberProofId,
        array $vatNumberProofImageFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param VatNumberProofImage $vatNumberProofImage
     *
     * @return bool
     */
    public function deleteImage(
        VatNumberProofImage $vatNumberProofImage
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $vatNumberProofImages
     *
     * @return bool
     */
    public function deleteImages(
        Collection $vatNumberProofImages
    ) : bool;
}
