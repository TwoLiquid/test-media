<?php

namespace App\Services\VatNumber\Interfaces;

use App\Models\MySql\VatNumberProof\VatNumberProofDocument;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface VatNumberProofDocumentServiceInterface
 *
 * @package App\Services\VatNumber\Interfaces
 */
interface VatNumberProofDocumentServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $vatNumberProofId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return VatNumberProofDocument
     */
    public function createDocument(
        string $vatNumberProofId,
        string $content,
        string $mime,
        string $extension
    ) : VatNumberProofDocument;

    /**
     * This method provides creating data
     *
     * @param string $vatNumberProofId
     * @param array $vatNumberProofDocumentFiles
     *
     * @return Collection
     */
    public function createDocuments(
        string $vatNumberProofId,
        array $vatNumberProofDocumentFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param VatNumberProofDocument $vatNumberProofDocument
     *
     * @return bool
     */
    public function deleteDocument(
        VatNumberProofDocument $vatNumberProofDocument
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $vatNumberProofDocuments
     *
     * @return bool
     */
    public function deleteDocuments(
        Collection $vatNumberProofDocuments
    ) : bool;
}
