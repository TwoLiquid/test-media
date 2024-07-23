<?php

namespace App\Transformers\Api\General\Withdrawal;

use App\Models\MySql\WithdrawalReceiptProof\WithdrawalReceiptProofDocument;
use App\Transformers\BaseTransformer;

/**
 * Class WithdrawalReceiptProofDocumentTransformer
 *
 * @package App\Transformers\Api\General\Withdrawal
 */
class WithdrawalReceiptProofDocumentTransformer extends BaseTransformer
{
    /**
     * @param WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument
     *
     * @return array
     */
    public function transform(WithdrawalReceiptProofDocument $withdrawalReceiptProofDocument) : array
    {
        return [
            'id'         => $withdrawalReceiptProofDocument->id,
            'receipt_id' => $withdrawalReceiptProofDocument->receipt_id,
            'url'        => generateFullStorageLink($withdrawalReceiptProofDocument->url),
            'mime'       => $withdrawalReceiptProofDocument->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'withdrawal_receipt_proof_document';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'withdrawal_receipt_proof_documents';
    }
}
