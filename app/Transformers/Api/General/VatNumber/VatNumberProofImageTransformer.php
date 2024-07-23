<?php

namespace App\Transformers\Api\General\VatNumber;

use App\Models\MySql\VatNumberProof\VatNumberProofImage;
use App\Transformers\BaseTransformer;

/**
 * Class VatNumberProofImageTransformer
 *
 * @package App\Transformers\Api\General\VatNumber
 */
class VatNumberProofImageTransformer extends BaseTransformer
{
    /**
     * @param VatNumberProofImage $vatNumberProofImage
     *
     * @return array
     */
    public function transform(VatNumberProofImage $vatNumberProofImage) : array
    {
        return [
            'id'                  => $vatNumberProofImage->id,
            'vat_number_proof_id' => $vatNumberProofImage->vat_number_proof_id,
            'url'                 => generateFullStorageLink($vatNumberProofImage->url),
            'url_min'             => generateFullStorageLink(getMinimizedFilePath($vatNumberProofImage->url)),
            'mime'                => $vatNumberProofImage->mime,
            'created_at'          => $vatNumberProofImage->created_at->format('Y-m-d\TH:i:s.v\Z')
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'vat_number_proof_image';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'vat_number_proof_images';
    }
}
