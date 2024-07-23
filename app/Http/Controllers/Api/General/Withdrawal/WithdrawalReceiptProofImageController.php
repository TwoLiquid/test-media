<?php

namespace App\Http\Controllers\Api\General\Withdrawal;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Withdrawal\Interfaces\WithdrawalReceiptProofImageControllerInterface;
use App\Http\Requests\Api\General\Withdrawal\Receipt\Proof\Image\StoreManyRequest;
use App\Repositories\Withdrawal\WithdrawalReceiptProofImageRepository;
use App\Services\Withdrawal\WithdrawalReceiptProofImageService;
use App\Transformers\Api\General\Withdrawal\WithdrawalReceiptProofImageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class WithdrawalReceiptProofImageController
 *
 * @package App\Http\Controllers\Api\General\Withdrawal
 */
final class WithdrawalReceiptProofImageController extends BaseController implements WithdrawalReceiptProofImageControllerInterface
{
    /**
     * @var WithdrawalReceiptProofImageRepository
     */
    protected WithdrawalReceiptProofImageRepository $withdrawalReceiptProofImageRepository;

    /**
     * @var WithdrawalReceiptProofImageService
     */
    protected WithdrawalReceiptProofImageService $withdrawalReceiptProofImageService;

    /**
     * WithdrawalReceiptProofImageController constructor
     */
    public function __construct()
    {
        /** @var WithdrawalReceiptProofImageRepository withdrawalReceiptProofImageRepository */
        $this->withdrawalReceiptProofImageRepository = new WithdrawalReceiptProofImageRepository();

        /** @var WithdrawalReceiptProofImageService withdrawalReceiptProofImageService */
        $this->withdrawalReceiptProofImageService = new WithdrawalReceiptProofImageService();

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
         * Creating withdrawal receipt proof images
         */
        $withdrawalReceiptProofImages = $this->withdrawalReceiptProofImageService->createImages(
            $withdrawalReceiptProofId,
            $request->input('withdrawal_receipt_proof_images')
        );

        return $this->respondWithSuccess(
            $this->transformCollection(
                $withdrawalReceiptProofImages,
                new WithdrawalReceiptProofImageTransformer
            ), trans('validations/api/general/withdrawal/receipt/proof/image/storeMany.result.success')
        );
    }
}
