<?php

namespace App\Services\Withdrawal\Interfaces;

use App\Models\MySql\WithdrawalReceiptProof\WithdrawalReceiptProofDocument;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface WithdrawalReceiptProofDocumentServiceInterface
 *
 * @package App\Services\WithdrawalReceiptProof\Interfaces
 */
interface WithdrawalReceiptProofDocumentServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $receiptId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return WithdrawalReceiptProofDocument
     */
    public function createDocument(
        string $receiptId,
        string $content,
        string $mime,
        string $extension
    ) : WithdrawalReceiptProofDocument;

    /**
     * This method provides creating data
     *
     * @param string $receiptId
     * @param array $withdrawalReceiptProofDocumentFiles
     *
     * @return Collection
     */
    public function createDocuments(
        string $receiptId,
        array $withdrawalReceiptProofDocumentFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument
     *
     * @return bool
     */
    public function deleteDocument(
        WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $withdrawalReceiptProofDocuments
     *
     * @return bool
     */
    public function deleteDocuments(
        Collection $withdrawalReceiptProofDocuments
    ) : bool;
}
