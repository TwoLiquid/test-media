<?php

namespace App\Http\Controllers\Api\General\VatNumber;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\VatNumber\Interfaces\VatNumberProofDocumentControllerInterface;
use App\Http\Requests\Api\General\VatNumber\Proof\Document\StoreManyRequest;
use App\Repositories\VatNumber\VatNumberProofDocumentRepository;
use App\Services\VatNumber\VatNumberProofDocumentService;
use App\Transformers\Api\General\VatNumber\VatNumberProofDocumentTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class VatNumberProofDocumentController
 *
 * @package App\Http\Controllers\Api\General\VatNumber
 */
final class VatNumberProofDocumentController extends BaseController implements VatNumberProofDocumentControllerInterface
{
    /**
     * @var VatNumberProofDocumentRepository
     */
    protected VatNumberProofDocumentRepository $vatNumberProofDocumentRepository;

    /**
     * @var VatNumberProofDocumentService
     */
    protected VatNumberProofDocumentService $vatNumberProofDocumentService;

    /**
     * VatNumberProofDocumentController constructor
     */
    public function __construct()
    {
        /** @var VatNumberProofDocumentRepository vatNumberProofDocumentRepository */
        $this->vatNumberProofDocumentRepository = new VatNumberProofDocumentRepository();

        /** @var VatNumberProofDocumentService vatNumberProofDocumentService */
        $this->vatNumberProofDocumentService = new VatNumberProofDocumentService();

        parent::__construct();
    }

    /**
     * @param string $vatNumberProofId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function storeMany(
        string $vatNumberProofId,
        StoreManyRequest $request
    ) : JsonResponse
    {
        /**
         * Creating vat number proof documents
         */
        $vatNumberProofDocuments = $this->vatNumberProofDocumentService->createDocuments(
            $vatNumberProofId,
            $request->input('vat_number_proof_documents')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($vatNumberProofDocuments, new VatNumberProofDocumentTransformer),
            trans('validations/api/general/vatNumber/proof/document/storeMany.result.success')
        );
    }
}
