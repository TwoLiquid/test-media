<?php

namespace App\Transformers\Api\General\VatNumber;

use App\Models\MySql\VatNumberProof\VatNumberProofDocument;
use App\Transformers\BaseTransformer;

/**
 * Class VatNumberProofDocumentTransformer
 *
 * @package App\Transformers\Api\General\VatNumber
 */
class VatNumberProofDocumentTransformer extends BaseTransformer
{
    /**
     * @param VatNumberProofDocument $vatNumberProofDocument
     *
     * @return array
     */
    public function transform(VatNumberProofDocument $vatNumberProofDocument) : array
    {
        return [
            'id'                  => $vatNumberProofDocument->id,
            'vat_number_proof_id' => $vatNumberProofDocument->vat_number_proof_id,
            'url'                 => generateFullStorageLink($vatNumberProofDocument->url),
            'mime'                => $vatNumberProofDocument->mime,
            'created_at'          => $vatNumberProofDocument->created_at->format('Y-m-d\TH:i:s.v\Z')
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'vat_number_proof_document';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'vat_number_proof_documents';
    }
}
