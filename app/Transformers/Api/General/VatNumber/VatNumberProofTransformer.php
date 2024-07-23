<?php

namespace App\Transformers\Api\General\VatNumber;

use App\Transformers\BaseTransformer;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use League\Fractal\Resource\Collection;

/**
 * Class VatNumberProofTransformer
 *
 * @package App\Transformers\Api\General\VatNumber
 */
class VatNumberProofTransformer extends BaseTransformer
{
    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $vatNumberProofImages;

    /**
     * @var EloquentCollection
     */
    protected EloquentCollection $vatNumberProofDocuments;

    /**
     * VatNumberProofTransformer constructor
     *
     * @param EloquentCollection $vatNumberProofImages
     * @param EloquentCollection $vatNumberProofDocuments
     */
    public function __construct(
        EloquentCollection $vatNumberProofImages,
        EloquentCollection $vatNumberProofDocuments
    )
    {
        $this->vatNumberProofImages = $vatNumberProofImages;
        $this->vatNumberProofDocuments = $vatNumberProofDocuments;
    }

    /**
     * @var array
     */
    protected array $defaultIncludes = [
        'vat_number_proof_images',
        'vat_number_proof_documents'
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
    public function includeVatNumberProofImages() : ?Collection
    {
        $vatNumberProofImages = $this->vatNumberProofImages;

        return $this->collection($vatNumberProofImages, new VatNumberProofImageTransformer);
    }

    /**
     * @return Collection|null
     */
    public function includeVatNumberProofDocuments() : ?Collection
    {
        $vatNumberProofDocuments = $this->vatNumberProofDocuments;

        return $this->collection($vatNumberProofDocuments, new VatNumberProofDocumentTransformer);
    }

    /**
     * @return string
     */
    public function getItemKey() : string
    {
        return 'vat_number_proof';
    }

    /**
     * @return string
     */
    public function getCollectionKey() : string
    {
        return 'vat_number_proofs';
    }
}
