<?php

namespace App\Http\Controllers\Api\General\VatNumber;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\VatNumber\Interfaces\VatNumberProofImageControllerInterface;
use App\Http\Requests\Api\General\VatNumber\Proof\Image\StoreManyRequest;
use App\Repositories\VatNumber\VatNumberProofImageRepository;
use App\Services\VatNumber\VatNumberProofImageService;
use App\Transformers\Api\General\VatNumber\VatNumberProofImageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class VatNumberProofImageController
 *
 * @package App\Http\Controllers\Api\General\VatNumber
 */
final class VatNumberProofImageController extends BaseController implements VatNumberProofImageControllerInterface
{
    /**
     * @var VatNumberProofImageRepository
     */
    protected VatNumberProofImageRepository $vatNumberProofImageRepository;

    /**
     * @var VatNumberProofImageService
     */
    protected VatNumberProofImageService $vatNumberProofImageService;

    /**
     * VatNumberProofImageController constructor
     */
    public function __construct()
    {
        /** @var VatNumberProofImageRepository vatNumberProofImageRepository */
        $this->vatNumberProofImageRepository = new VatNumberProofImageRepository();

        /** @var VatNumberProofImageService vatNumberProofImageService */
        $this->vatNumberProofImageService = new VatNumberProofImageService();

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
         * Creating vat number proof images
         */
        $vatNumberProofDocuments = $this->vatNumberProofImageService->createImages(
            $vatNumberProofId,
            $request->input('vat_number_proof_images')
        );

        return $this->respondWithSuccess(
            $this->transformCollection(
                $vatNumberProofDocuments,
                new VatNumberProofImageTransformer
            ), trans('validations/api/general/vatNumber/proof/image/storeMany.result.success')
        );
    }
}
