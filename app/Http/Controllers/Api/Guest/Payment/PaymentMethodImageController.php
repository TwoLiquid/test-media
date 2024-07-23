<?php

namespace App\Http\Controllers\Api\Guest\Payment;

use App\Exceptions\DatabaseException;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Guest\Payment\Interfaces\PaymentMethodImageControllerInterface;
use App\Http\Requests\Api\Guest\Payment\Method\Image\GetForPaymentMethodsRequest;
use App\Repositories\Payment\PaymentMethodImageRepository;
use App\Services\Payment\PaymentMethodImageService;
use App\Transformers\Api\Guest\Payment\PaymentMethodImageTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class PaymentMethodImageController
 *
 * @package App\Http\Controllers\Api\Guest\Payment
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

        /** @var PaymentMethodImageService paymentMethodImageService */
        $this->paymentMethodImageService = new PaymentMethodImageService();

        parent::__construct();
    }

    /**
     * @param int $paymentMethodId
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForPaymentMethod(
        int $paymentMethodId
    ) : JsonResponse
    {
        /**
         * Getting payment method images
         */
        $paymentMethodImages = $this->paymentMethodImageRepository->getForMethod(
            $paymentMethodId
        );

        return $this->respondWithSuccess(
            $this->transformCollection($paymentMethodImages, new PaymentMethodImageTransformer),
            trans('validations/api/guest/payment/method/image/getForPaymentMethod.result.success')
        );
    }

    /**
     * @param GetForPaymentMethodsRequest $request
     *
     * @return JsonResponse
     *
     * @throws DatabaseException
     */
    public function getForPaymentMethods(
        GetForPaymentMethodsRequest $request
    ) : JsonResponse
    {
        /**
         * Getting payment method images
         */
        $paymentMethodImages = $this->paymentMethodImageRepository->getForMethods(
            $request->input('payment_methods_ids')
        );

        return $this->respondWithSuccess(
            $this->transformCollection($paymentMethodImages, new PaymentMethodImageTransformer),
            trans('validations/api/guest/payment/method/image/getForPaymentMethods.result.success')
        );
    }
}
