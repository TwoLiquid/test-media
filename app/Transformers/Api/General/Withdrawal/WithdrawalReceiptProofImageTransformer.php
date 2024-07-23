<?php

namespace App\Transformers\Api\General\Withdrawal;

use App\Models\MySql\WithdrawalReceiptProof\WithdrawalReceiptProofImage;
use App\Transformers\BaseTransformer;

/**
 * Class WithdrawalReceiptProofImageTransformer
 *
 * @package App\Transformers\Api\General\Withdrawal
 */
class WithdrawalReceiptProofImageTransformer extends BaseTransformer
{
    /**
     * @param WithdrawalReceiptProofImage $withdrawalReceiptProofImage
     *
     * @return array
     */
    public function transform(WithdrawalReceiptProofImage $withdrawalReceiptProofImage) : array
    {
        return [
            'id'         => $withdrawalReceiptProofImage->id,
            'receipt_id' => $withdrawalReceiptProofImage->receipt_id,
            'url'        => generateFullStorageLink($withdrawalReceiptProofImage->url),
            'mime'       => $withdrawalReceiptProofImage->mime
        ];
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'withdrawal_receipt_proof_image';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'withdrawal_receipt_proof_images';
    }
}
