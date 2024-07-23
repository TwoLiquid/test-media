<?php

namespace App\Services\Withdrawal\Interfaces;

use App\Models\MySql\WithdrawalReceiptProof\WithdrawalReceiptProofImage;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface WithdrawalReceiptProofImageServiceInterface
 *
 * @package App\Services\WithdrawalReceiptProof\Interfaces
 */
interface WithdrawalReceiptProofImageServiceInterface
{
    /**
     * This method provides creating data
     *
     * @param string $receiptId
     * @param string $content
     * @param string $mime
     * @param string $extension
     *
     * @return WithdrawalReceiptProofImage
     */
    public function createImage(
        string $receiptId,
        string $content,
        string $mime,
        string $extension
    ) : WithdrawalReceiptProofImage;

    /**
     * This method provides creating data
     *
     * @param string $receiptId
     * @param array $withdrawalReceiptProofImageFiles
     *
     * @return Collection
     */
    public function createImages(
        string $receiptId,
        array $withdrawalReceiptProofImageFiles
    ) : Collection;

    /**
     * This method provides deleting data
     *
     * @param WithdrawalReceiptProofImage $withdrawalReceiptProofImage
     *
     * @return bool
     */
    public function deleteImage(
        WithdrawalReceiptProofImage $withdrawalReceiptProofImage
    ) : bool;

    /**
     * This method provides deleting data
     *
     * @param Collection $withdrawalReceiptProofImages
     *
     * @return bool
     */
    public function deleteImages(
        Collection $withdrawalReceiptProofImages
    ) : bool;
}
