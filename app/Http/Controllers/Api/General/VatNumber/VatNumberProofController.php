<?php

namespace App\Http\Controllers\Api\General\VatNumber;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\VatNumber\Interfaces\VatNumberProofControllerInterface;
use App\Http\Requests\Api\General\VatNumber\Proof\GetForVatNumberProofsRequest;
use App\Repositories\VatNumber\VatNumberProofDocumentRepository;
use App\Repositories\VatNumber\VatNumberProofImageRepository;
use App\Transformers\Api\General\VatNumber\VatNumberProofTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class VatNumberProofController
 *
 * @package App\Http\Controllers\Api\General\VatNumber
 */
final class VatNumberProofController extends BaseController implements VatNumberProofControllerInterface
{
    /**
     * @var VatNumberProofDocumentRepository
     */
    protected VatNumberProofDocumentRepository $vatNumberProofDocumentRepository;

    /**
     * @var VatNumberProofImageRepository
     */
    protected VatNumberProofImageRepository $vatNumberProofImageRepository;

    /**
     * VatNumberProofController constructor
     */
    public function __construct()
    {
        /** @var VatNumberProofDocumentRepository vatNumberProofDocumentRepository */
        $this->vatNumberProofDocumentRepository = new VatNumberProofDocumentRepository();

        /** @var VatNumberProofImageRepository vatNumberProofImageRepository */
        $this->vatNumberProofImageRepository = new VatNumberProofImageRepository();

        parent::__construct();
    }

    /**
     * @param string $vatNumberProofId
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForVatNumberProof(
        string $vatNumberProofId
    ) : JsonResponse
    {
        /**
         * Getting vat number proof images
         */
        $vatNumberProofImages = $this->vatNumberProofImageRepository->getForVatNumberProof(
            $vatNumberProofId
        );

        /**
         * Getting vat number proof documents
         */
        $vatNumberProofDocuments = $this->vatNumberProofDocumentRepository->getForVatNumberProof(
            $vatNumberProofId
        );

        return $this->respondWithSuccess(
            $this->transformItem([], new VatNumberProofTransformer(
                $vatNumberProofImages,
                $vatNumberProofDocuments
            ))['vat_number_proof'],
            trans('validations/api/general/vatNumber/proof/getForVatNumberProof.result.success')
        );
    }

    /**
     * @param GetForVatNumberProofsRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForVatNumberProofs(
        GetForVatNumberProofsRequest $request
    ) : JsonResponse
    {
        /**
         * Getting vat number proof images
         */
        $vatNumberProofImages = $this->vatNumberProofImageRepository->getForVatNumberProofs(
            $request->input('vat_number_proofs_ids')
        );

        /**
         * Getting vat number proof documents
         */
        $vatNumberProofDocuments = $this->vatNumberProofDocumentRepository->getForVatNumberProofs(
            $request->input('vat_number_proofs_ids')
        );

        return $this->respondWithSuccess(
            $this->transformItem([], new VatNumberProofTransformer(
                $vatNumberProofImages,
                $vatNumberProofDocuments
            ))['vat_number_proof'],
            trans('validations/api/general/vatNumber/proof/getForVatNumberProofs.result.success')
        );
    }
}
