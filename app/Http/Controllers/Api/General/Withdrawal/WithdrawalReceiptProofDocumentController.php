<?php

namespace App\Http\Controllers\Api\General\Withdrawal;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Withdrawal\Interfaces\WithdrawalReceiptProofDocumentControllerInterface;
use App\Http\Requests\Api\General\Withdrawal\Receipt\Proof\Document\StoreManyRequest;
use App\Repositories\Withdrawal\WithdrawalReceiptProofDocumentRepository;
use App\Services\Withdrawal\WithdrawalReceiptProofDocumentService;
use App\Transformers\Api\General\Withdrawal\WithdrawalReceiptProofDocumentTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class WithdrawalReceiptProofDocumentController
 *
 * @package App\Http\Controllers\Api\General\Withdrawal
 */
final class WithdrawalReceiptProofDocumentController extends BaseController implements WithdrawalReceiptProofDocumentControllerInterface
{
    /**
     * @var WithdrawalReceiptProofDocumentRepository
     */
    protected WithdrawalReceiptProofDocumentRepository $withdrawalReceiptProofDocumentRepository;

    /**
     * @var WithdrawalReceiptProofDocumentService
     */
    protected WithdrawalReceiptProofDocumentService $withdrawalReceiptProofDocumentService;

    /**
     * WithdrawalReceiptProofDocumentController constructor
     */
    public function __construct()
    {
        /** @var WithdrawalReceiptProofDocumentRepository withdrawalReceiptProofDocumentRepository */
        $this->withdrawalReceiptProofDocumentRepository = new WithdrawalReceiptProofDocumentRepository();

        /** @var WithdrawalReceiptProofDocumentService withdrawalReceiptProofDocumentService */
        $this->withdrawalReceiptProofDocumentService = new WithdrawalReceiptProofDocumentService();

        parent::__construct();
    }

    /**
     * @param string $withdrawalReceiptProofId
     * @param StoreManyRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function storeMany(
        string $withdrawalReceiptProofId,
        StoreManyRequest $request
    ) : JsonResponse
    {
        /**
         * Creating withdrawal receipt proof documents
         */
        $withdrawalReceiptProofDocuments = $this->withdrawalReceiptProofDocumentService->createDocuments(
            $withdrawalReceiptProofId,
            $request->input('withdrawal_receipt_proof_documents')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($withdrawalReceiptProofDocuments, new WithdrawalReceiptProofDocumentTransformer),
            trans('validations/api/general/withdrawal/receipt/proof/document/storeMany.result.success')
        );
    }
}
