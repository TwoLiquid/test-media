<?php

namespace App\Transformers\Api\General\Withdrawal;

use App\Transformers\BaseTransformer;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use League\Fractal\Resource\Collection;

/**
 * Class WithdrawalReceiptProofTransformer
 *
 * @package App\Transformers\Api\General\Withdrawal
 */
class WithdrawalReceiptProofTransformer extends BaseTransformer
{
    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $withdrawalReceiptProofImages;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $withdrawalReceiptProofDocuments;

    /**
     * WithdrawalReceiptProofTransformer constructor
     *
     * @param EloquentCollection $withdrawalReceiptProofImages
     * @param EloquentCollection $withdrawalReceiptProofDocuments
     */
    public function __construct(
        EloquentCollection $withdrawalReceiptProofImages,
        EloquentCollection $withdrawalReceiptProofDocuments
    )
    {
        $this->withdrawalReceiptProofImages = $withdrawalReceiptProofImages;
        $this->withdrawalReceiptProofDocuments = $withdrawalReceiptProofDocuments;
    }

    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'withdrawal_receipt_proof_images',
        'withdrawal_receipt_proof_documents'
    ];

    /**
     * @return array
     */
    public function transform() : array
    {
        return [];
    }

    /**
     * @return Collection|null
     */
    public function includeWithdrawalReceiptProofImages() : ?Collection
    {
        $withdrawalReceiptProofImages = $this->withdrawalReceiptProofImages;

        return $this->collection($withdrawalReceiptProofImages, new WithdrawalReceiptProofImageTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeWithdrawalReceiptProofDocuments() : ?Collection
    {
        $withdrawalReceiptProofDocuments = $this->withdrawalReceiptProofDocuments;

        return $this->collection($withdrawalReceiptProofDocuments, new WithdrawalReceiptProofDocumentTransformer);
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'withdrawal_receipt_proof';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'withdrawal_receipt_proofs';
    }
}
