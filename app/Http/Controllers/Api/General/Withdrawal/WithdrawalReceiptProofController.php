<?php

namespace App\Http\Controllers\Api\General\Withdrawal;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Withdrawal\Interfaces\WithdrawalReceiptProofControllerInterface;
use App\Http\Requests\Api\General\Withdrawal\Receipt\Proof\GetForWithdrawalReceiptProofsRequest;
use App\Repositories\Withdrawal\WithdrawalReceiptProofDocumentRepository;
use App\Repositories\Withdrawal\WithdrawalReceiptProofImageRepository;
use App\Transformers\Api\General\Withdrawal\WithdrawalReceiptProofTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class WithdrawalReceiptProofController
 *
 * @package App\Http\Controllers\Api\General\Withdrawal
 */
final class WithdrawalReceiptProofController extends BaseController implements WithdrawalReceiptProofControllerInterface
{
    /**
     * @var WithdrawalReceiptProofDocumentRepository
     */
    protected WithdrawalReceiptProofDocumentRepository $withdrawalReceiptProofDocumentRepository;

    /**
     * @var WithdrawalReceiptProofImageRepository
     */
    protected WithdrawalReceiptProofImageRepository $withdrawalReceiptProofImageRepository;

    /**
     * WithdrawalReceiptProofController constructor
     */
    public function __construct()
    {
        /** @var WithdrawalReceiptProofDocumentRepository withdrawalReceiptProofDocumentRepository */
        $this->withdrawalReceiptProofDocumentRepository = new WithdrawalReceiptProofDocumentRepository();

        /** @var WithdrawalReceiptProofImageRepository withdrawalReceiptProofImageRepository */
        $this->withdrawalReceiptProofImageRepository = new WithdrawalReceiptProofImageRepository();

        parent::__construct();
    }

    /**
     * @param string $withdrawalReceiptProofId
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForWithdrawalReceiptProof(
        string $withdrawalReceiptProofId
    ) : JsonResponse
    {
        /**
         * Getting withdrawal receipt proof images
         */
        $withdrawalReceiptProofImages = $this->withdrawalReceiptProofImageRepository->getForReceipt(
            $withdrawalReceiptProofId
        );

        /**
         * Getting withdrawal receipt proof documents
         */
        $withdrawalReceiptProofDocuments = $this->withdrawalReceiptProofDocumentRepository->getForReceipt(
            $withdrawalReceiptProofId
        );

        return $this->respondWithSuccess(
            $this->transformItem([], new WithdrawalReceiptProofTransformer(
                $withdrawalReceiptProofImages,
                $withdrawalReceiptProofDocuments
            ))['withdrawal_receipt_proof'],
            trans('validations/api/general/withdrawal/receipt/proof/getForWithdrawalReceiptProof.result.success')
        );
    }

    /**
     * @param GetForWithdrawalReceiptProofsRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForWithdrawalReceiptProofs(
        GetForWithdrawalReceiptProofsRequest $request
    ) : JsonResponse
    {
        /**
         * Getting withdrawal receipt proof images
         */
        $withdrawalReceiptProofImages = $this->withdrawalReceiptProofImageRepository->getForReceipts(
            $request->input('withdrawal_receipts_ids')
        );

        /**
         * Getting withdrawal receipt proof documents
         */
        $withdrawalReceiptProofDocuments = $this->withdrawalReceiptProofDocumentRepository->getForReceipts(
            $request->input('withdrawal_receipts_ids')
        );

        return $this->respondWithSuccess(
            $this->transformItem([], new WithdrawalReceiptProofTransformer(
                $withdrawalReceiptProofImages,
                $withdrawalReceiptProofDocuments
            ))['withdrawal_receipt_proof'],
            trans('validations/api/general/withdrawal/receipt/proof/getForWithdrawalReceiptProofs.result.success')
        );
    }
}
