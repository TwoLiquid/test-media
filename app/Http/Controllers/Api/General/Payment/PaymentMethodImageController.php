<?php

namespace App\Http\Controllers\Api\General\Payment;

use App\Exceptions\BaseException;
use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\General\Payment\Interfaces\PaymentMethodImageControllerInterface;
use App\Http\Requests\Api\General\Payment\Method\Image\StoreRequest;
use App\Repositories\Payment\PaymentMethodImageRepository;
use App\Services\Payment\PaymentMethodImageService;
use App\Transformers\Api\General\Payment\PaymentMethodImageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class PaymentMethodImageController
 *
 * @package App\Http\Controllers\Api\General\Payment
 */
final class PaymentMethodImageController extends BaseController implements PaymentMethodImageControllerInterface
{
    /**
     * @var PaymentMethodImageRepository
     */
    protected PaymentMethodImageRepository $paymentMethodImageRepository;

    /**
     * @var PaymentMethodImageService
     */
    protected PaymentMethodImageService $paymentMethodImageService;

    /**
     * PaymentMethodImageController constructor
     */
    public function __construct()
    {
        /** @var PaymentMethodImageRepository paymentMethodImageRepository */
        $this->paymentMethodImageRepository = new PaymentMethodImageRepository();

        /** @var PaymentMethodImageRepository paymentMethodImageService */
        $this->paymentMethodImageService = new PaymentMethodImageService();

        parent::__construct();
    }

    /**
     * @param int $paymentMethodId
     * @param StoreRequest $request
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function store(
        int $paymentMethodId,
        StoreRequest $request
    ) : JsonResponse
    {
        /**
         * Creating payment method image
         */
        $paymentMethodImage = $this->paymentMethodImageService->createImage(
            $paymentMethodId,
            $request->input('content'),
            $request->input('mime'),
            $request->input('extension')
        );

        return $this->respondWithSuccess(
            $this->transformItem($paymentMethodImage, new PaymentMethodImageTransformer),
            trans('validations/api/general/payment/method/image/store.result.success')
        );
    }

    /**
     * @param int $paymentMethodId
     *
     * @return JsonResponse
     *
     * @throws BaseException
     * @throws DatabaseException
     */
    public function destroy(
        int $paymentMethodId
    ) : JsonResponse
    {
        /**
         * Getting payment method images
         */
        $paymentMethodImages = $this->paymentMethodImageRepository->getForMethod(
            $paymentMethodId
        );

        /**
         * Deleting payment method images
         */
        $this->paymentMethodImageService->deleteImages(
            $paymentMethodImages
        );

        return $this->respondWithSuccess([],
            trans('validations/api/general/payment/method/image/destroy.result.success')
        );
    }
}
